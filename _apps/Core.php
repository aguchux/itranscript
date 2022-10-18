<?php

//Write your custome class/methods here
namespace Apps;

use \Apps\Model;

class Core extends Model
{

	public $token = NULL;
	public $session_timout = session_timout;

	public $domain = domain;

	/** @return exit  */
	public function __construct()
	{
		parent::__construct();
	}


	public function ToMoney($amount)
	{
		return '&#8358;' . number_format($amount, 2, '.', ',');
	}
	public function Money($amount)
	{
		return '&#8358;' . number_format($amount, 0, '.', ',');
	}

	public function Monify($amount)
	{
		return '&#8358;' . number_format($amount, 2, '.', ',');
	}

	public function Passwordify($password)
	{
		return md5(sha1($password));
	}




	/**
	 * @param mixed $time_ago
	 * @return string
	 */
	public function Cycle($time_ago)
	{
		$current_time    = time();
		$time_difference = $current_time - $time_ago;
		$seconds         = $time_difference;

		$minutes = round($seconds / 60); // value 60 is seconds
		$hours   = round($seconds / 3600); //value 3600 is 60 minutes * 60 sec
		$days    = round($seconds / 86400); //86400 = 24 * 60 * 60;
		$weeks   = round($seconds / 604800); // 7*24*60*60;
		$months  = round($seconds / 2629440); //((365+365+365+365+366)/5/12)*24*60*60
		$years   = round($seconds / 31553280); //(365+365+365+365+366)/5 * 24 * 60 * 60

		if ($seconds <= 60) {
			return "Just Now";
		} else if ($minutes <= 60) {
			if ($minutes == 1) {
				return "one minute ago";
			} else {
				return "$minutes minutes ago";
			}
		} else if ($hours <= 24) {
			if ($hours == 1) {
				return "an hour ago";
			} else {
				return "$hours hrs ago";
			}
		} else if ($days <= 7) {
			if ($days == 1) {
				return "yesterday";
			} else {
				return "$days days ago";
			}
		} else if ($weeks <= 4.3) {
			if ($weeks == 1) {
				return "a week ago";
			} else {
				return "$weeks weeks ago";
			}
		} else if ($months <= 12) {
			if ($months == 1) {
				return "a month ago";
			} else {
				return "$months months ago";
			}
		} else {
			if ($years == 1) {
				return "one year ago";
			} else {
				return "$years years ago";
			}
		}
	}




	public function SiteSettings()
	{
		$SiteSettings = $this->mysqli("SELECT * FROM esut_settings WHERE id='1'");
		$SiteSettings = mysqli_fetch_object($SiteSettings);
		return $SiteSettings;
	}

	public function setSettingsInfo($id, $keyname, $keyval)
	{
		$query = $this->mysqli("UPDATE esut_settings SET `{$keyname}`='$keyval' WHERE id='$id'");
		return (int)$this->countAffected();
	}



	public function EsutLogin($email, $password, $encrypt = true)
	{
		if ($encrypt) {
			$password = $this->Passwordify($password);
		}
		$query = $this->mysqli("SELECT * FROM esut_accounts WHERE email='$email' AND password='$password'");
		$query = mysqli_fetch_object($query);
		return $query;
	}

	public function QuickLogin($accid, $password)
	{
		$query = $this->mysqli("SELECT * FROM esut_accounts WHERE accid='$accid' AND password='$password'");
		$query = mysqli_fetch_object($query);
		return $query;
	}



	public function CountAccounts()
	{
		$query = $this->mysqli("SELECT count(accid) AS ctx FROM esut_accounts");
		$query = mysqli_fetch_object($query);
		return number_format($query->ctx, 0, '', ',');
	}


	public function Reroute($route)
	{
		$sess = new Template;
		$accid = $sess->storage('accid');
		if (($this->ProfileScore($accid) < 110) && ($route != "my.edit-profile")) {
			return "my.my";
		}
		return "{$route}";
	}



	public function EsutRegister($email, $password, $surname, $firstname)
	{
		$vericode = sha1($email . $password);
		$password = $this->Passwordify($password);
		$query = $this->mysqli("INSERT INTO esut_accounts(email,password,vericode,surname,firstname) VALUES('$email','$password','$vericode','$surname','$firstname') ");
		return $this->getLastId();
	}


	public function UserInfo($username)
	{
		$query = $this->mysqli("SELECT * FROM esut_accounts WHERE email='$username' OR accid='$username' OR vericode='$username'");
		$query = mysqli_fetch_object($query);
		return $query;
	}


	public function CountryInfo($country)
	{
		$query = $this->mysqli("SELECT * FROM countries WHERE id='$country'");
		$query = mysqli_fetch_object($query);
		return $query->name;
	}

	public function ApplyTranscript($accid, $matricnumber, $sessionadmitted, $sessiongraduated, $entrymode, $faculty, $department, $international)
	{
		$query = $this->mysqli("INSERT INTO esut_transcripts(accid,matricnumber,sessionadmitted,sessiongraduated,entrymode,faculty,department,international) VALUES('$accid','$matricnumber','$sessionadmitted','$sessiongraduated','$entrymode','$faculty','$department','$international') ");
		$transcriptid = (int)$this->getLastId();
		if ($transcriptid) {
			$amount = local_transcript_fee;
			if ($international) {
				$amount = international_transcript_fee;
			}
			$reference = md5($transcriptid . $accid);
			$payment = $this->CreatePayment($accid, $transcriptid, $amount, $reference);
			$this->setTrascriptInfo($transcriptid, "paymentid", $payment);
		}
		return (int)$this->getLastId();
	}



	public function Verification2Transcript($verifid, $switch)
	{
		$VerInfo = $this->VerificationInfo($verifid);

		switch ($switch) {
			case 'transcript_local':
				$query = $this->mysqli("INSERT INTO esut_transcripts(accid,matricnumber,sessionadmitted,sessiongraduated,entrymode,faculty,department,international,paymentid)
				VALUES('$VerInfo->accid','$VerInfo->matricnumber','$VerInfo->sessionadmitted','$VerInfo->sessiongraduated','$VerInfo->entrymode','$VerInfo->faculty','$VerInfo->department',0,'$VerInfo->paymentid') ");
				break;
			case 'transcript_international':
				$query = $this->mysqli("INSERT INTO esut_transcripts(accid,matricnumber,sessionadmitted,sessiongraduated,entrymode,faculty,department,international,paymentid)
				VALUES('$VerInfo->accid','$VerInfo->matricnumber','$VerInfo->sessionadmitted','$VerInfo->sessiongraduated','$VerInfo->entrymode','$VerInfo->faculty','$VerInfo->department',1,'$VerInfo->paymentid') ");
				break;
		}

		$transcriptid = (int)$this->getLastId();
		if ($transcriptid) {
			//Delete the Verification//
			$this->SetPaymentInfo($VerInfo->paymentid, "transcriptid", $transcriptid);
			$this->SetPaymentInfo($VerInfo->paymentid, "product", "transcript");

			$this->mysqli("DELETE esut_verifications.* FROM esut_verifications WHERE id='$verifid'");
			//Delete the Verification//
		}
		return $transcriptid;
	}


	public function Transcript2Verification($verifid, $switch)
	{
		$VerInfo = $this->TranscriptInfo($verifid);

		switch ($switch) {
			case 'verification_certificate':
				$query = $this->mysqli("INSERT INTO esut_verifications(accid,matricnumber,sessionadmitted,sessiongraduated,entrymode,faculty,department,international,paymentid,verify)
				VALUES('$VerInfo->accid','$VerInfo->matricnumber','$VerInfo->sessionadmitted','$VerInfo->sessiongraduated','$VerInfo->entrymode','$VerInfo->faculty','$VerInfo->department','$VerInfo->international','$VerInfo->paymentid','certificate') ");
				break;
			case 'verification_local':
				$query = $this->mysqli("INSERT INTO esut_verifications(accid,matricnumber,sessionadmitted,sessiongraduated,entrymode,faculty,department,international,paymentid,verify)
				VALUES('$VerInfo->accid','$VerInfo->matricnumber','$VerInfo->sessionadmitted','$VerInfo->sessiongraduated','$VerInfo->entrymode','$VerInfo->faculty','$VerInfo->department',0,'$VerInfo->paymentid','transcript') ");
				break;
			case 'verification_international':
				$query = $this->mysqli("INSERT INTO esut_verifications(accid,matricnumber,sessionadmitted,sessiongraduated,entrymode,faculty,department,international,paymentid,verify)
				VALUES('$VerInfo->accid','$VerInfo->matricnumber','$VerInfo->sessionadmitted','$VerInfo->sessiongraduated','$VerInfo->entrymode','$VerInfo->faculty','$VerInfo->department',1,'$VerInfo->paymentid','transcript') ");
				break;
		}

		$transcriptid = (int)$this->getLastId();
		if ($transcriptid) {

			//Delete the Verification//
			$this->SetPaymentInfo($VerInfo->paymentid, "verificationid", $transcriptid);
			$this->SetPaymentInfo($VerInfo->paymentid, "product", "verification");

			$this->mysqli("DELETE esut_transcripts.* FROM esut_transcripts WHERE id='$verifid'");
			//Delete the Verification//

		}
		return $transcriptid;
	}


	public function StartApplyTranscript($accid, $matricnumber, $payment_mode, $international)
	{
		$query = $this->mysqli("INSERT INTO esut_transcripts(accid,matricnumber,payment_mode,international) VALUES('$accid','$matricnumber','$payment_mode','$international') ");
		$transcriptid = (int)$this->getLastId();
		if ($transcriptid) {
			$amount = local_transcript_fee;
			if ($international) {
				$amount = international_transcript_fee;
			}
			$reference = md5($transcriptid . $accid);
			$payment = $this->CreatePayment($accid, $transcriptid, $amount, $reference);
			$this->setTrascriptInfo($transcriptid, "paymentid", $payment);
		}
		return (int)$this->getLastId();
	}




	public function StartVerifyTranscript($accid, $matricnumber, $payment_mode, $international)
	{
		$query = $this->mysqli("INSERT INTO esut_verifications(accid,matricnumber,payment_mode,international,verify) VALUES('$accid','$matricnumber','$payment_mode','$international','transcript') ");
		$verifyid = (int)$this->getLastId();
		if ($verifyid) {
			$amount = local_transcript_verification_fee;
			if ($international) {
				$amount = international_transcript_verification_fee;
			}
			$reference = md5($verifyid . $accid);
			$payment = $this->CreateTVPayment($accid, $verifyid, $amount, $reference);
			$this->setVerificationInfo($verifyid, "paymentid", $payment);
		}
		return (int)$this->getLastId();
	}


	public function StartVerifyCertificate($accid, $matricnumber, $payment_mode)
	{
		$query = $this->mysqli("INSERT INTO esut_verifications(accid,matricnumber,payment_mode,verify) VALUES('$accid','$matricnumber','$payment_mode','certificate') ");
		$verifyid = (int)$this->getLastId();
		if ($verifyid) {
			$amount = certificate_verification_fee;
			$reference = md5($verifyid . $accid);
			$payment = $this->CreateCVPayment($accid, $verifyid, $amount, $reference);
			$this->setVerificationInfo($verifyid, "paymentid", $payment);
		}
		return (int)$this->getLastId();
	}

	public function AdminUpdateStatus($verifid, $accid, $status, $status_messag, $admin)
	{
		$query = $this->mysqli("INSERT INTO esut_updates(productid,accid,status,message,product,admin) VALUES('$verifid','$accid','$status','$status_messag','transcript','$admin') ");
		return (int)$this->getLastId();
	}

	public function CountStatusUpdateInfo($statusid)
	{
		$query = $this->mysqli("SELECT COUNT(id) AS cntx FROM esut_updates WHERE productid='$statusid'");
		$query = mysqli_fetch_object($query);
		return (int)$query->cntx;
	}


	public function UserUpdateStatus($verifid, $accid, $status_messag, $admin)
	{
		$query = $this->mysqli("INSERT INTO esut_updates(productid,accid,message,product,admin,reply) VALUES('$verifid','$accid','$status_messag','transcript','$admin',1) ");
		return (int)$this->getLastId();
	}


	public function StatusUpdateInfo($statusid)
	{
		$query = $this->mysqli("SELECT * FROM esut_updates WHERE id='$statusid'");
		$query = mysqli_fetch_object($query);
		return $query;
	}

	public function SetPaymentInfo($id, $key, $val)
	{
		mysqli_query($this->dbCon, "UPDATE esut_payments SET $key='$val' where id='$id'");
		return mysqli_affected_rows($this->dbCon);
	}

	public function UserHasPayment($accid, $subscription)
	{
		$Sub = mysqli_query($this->dbCon, "SELECT * FROM esut_payments WHERE accid='$accid' AND subscription='$subscription'");
		return mysqli_affected_rows($this->dbCon);
	}

	public function SetPaystackPaymentInfo($id, $key, $val)
	{
		$SetPaystackPaymentInfo = mysqli_query($this->dbCon, "UPDATE esut_payments SET `$key`='$val' where id='$id') ");
		return mysqli_affected_rows($this->dbCon);
	}

	public function PaymentInfoByReference($reference)
	{
		$PaymentInfoByReference = mysqli_query($this->dbCon, "select * from esut_payments where reference='$reference'");
		$PaymentInfoByReference = mysqli_fetch_object($PaymentInfoByReference);
		return $PaymentInfoByReference;
	}



	public function CreateTVPayment($accid, $verifyid, $amount, $reference)
	{
		$query = $this->mysqli("INSERT INTO esut_payments(product, accid,verificationid,amount,reference) VALUES('verification','$accid','$verifyid','$amount','$reference') ");
		return (int)$this->getLastId();
	}


	public function CreateCVPayment($accid, $verifyid, $amount, $reference)
	{
		$query = $this->mysqli("INSERT INTO esut_payments(product,accid,verificationid,amount,reference) VALUES('verification','$accid','$verifyid','$amount','$reference') ");
		return (int)$this->getLastId();
	}



	public function CreatePayment($accid, $transcriptid, $amount, $reference)
	{
		$query = $this->mysqli("INSERT INTO esut_payments(accid,transcriptid,amount,reference) VALUES('$accid','$transcriptid','$amount','$reference') ");
		return (int)$this->getLastId();
	}




	public function setVerificationInfo($id, $keyname, $keyval)
	{
		$query = $this->mysqli("UPDATE esut_verifications SET `{$keyname}`='$keyval' WHERE id='$id'");
		return (int)$this->countAffected();
	}


	public function setTrascriptInfo($id, $keyname, $keyval)
	{
		$query = $this->mysqli("UPDATE esut_transcripts SET `{$keyname}`='$keyval' WHERE id='$id'");
		return (int)$this->countAffected();
	}

	public function HasApplication($accid)
	{
		$query = $this->mysqli("SELECT count(id) AS cntx FROM esut_transcripts WHERE accid='$accid'");
		$query = mysqli_fetch_object($query);
		return (int)$query->cntx;
	}

	public function HasVerification($accid)
	{
		$query = $this->mysqli("SELECT count(id) AS cntx FROM esut_verifications WHERE accid='$accid'");
		$query = mysqli_fetch_object($query);
		return (int)$query->cntx;
	}

	public function Applications($accid)
	{
		$query = $this->mysqli("SELECT * FROM esut_transcripts WHERE accid='$accid' ORDER BY created DESC");
		return $query;
	}


	public function CleanApplication($id)
	{
		$del = 1;
		$Payment = $this->InvoiceInfo($id);
		$tid = $Payment->transcriptid;
		$vid = $Payment->verificationid;
		if ($tid > 0) {
			$del += (int) $this->mysqli("DELETE esut_transcripts.* FROM esut_transcripts WHERE id='{$tid}' ");
			//exit($tid);
		} elseif ($vid > 0) {
			$del += (int) $this->mysqli("DELETE esut_verifications.* FROM esut_verifications WHERE id='{$vid}'");
			//exit($vid);
		}
		// $delPay = (int)$this->mysqli("DELETE esut_payments.* FROM esut_payments WHERE id='$id'");
		return $del;
	}

	public function DeleteMarkedApplications()
	{
		$query = $this->mysqli("DELETE esut_transcripts.* FROM esut_transcripts WHERE todelete='1'");
		return $query;
	}

	public function DeleteMarkedInvoices()
	{
		$query = $this->mysqli("DELETE esut_payments.* FROM esut_payments WHERE todelete='1'");
		return $query;
	}

	public function UnpaidInvoices($limit = 100)
	{
		$query = $this->mysqli("SELECT * FROM esut_payments WHERE tranx_status='pending' ORDER BY created DESC LIMIT 0,$limit");
		return $query;
	}

	public function UnpaidApplications($limit = 50)
	{
		$query = $this->mysqli("SELECT * FROM esut_transcripts WHERE tranx_status='pending' ORDER BY created DESC LIMIT 0,$limit");
		return $query;
	}



	public function StatusUpdatesList($id)
	{
		$query = $this->mysqli("SELECT * FROM esut_updates WHERE productid='$id' ORDER BY created DESC");
		return $query;
	}


	public function Verifications($accid)
	{
		$query = $this->mysqli("SELECT * FROM esut_verifications WHERE accid='$accid' ORDER BY created DESC");
		return $query;
	}


	public function Invoices($accid)
	{
		$query = $this->mysqli("SELECT * FROM esut_payments WHERE accid='$accid' ORDER BY created DESC");
		return $query;
	}



	public function HasInvoice($accid)
	{
		$query = $this->mysqli("SELECT COUNT(id) AS cntx FROM esut_payments WHERE (accid='$accid' AND tranx_status='pending') ");
		$query = mysqli_fetch_object($query);
		return (int)$query->cntx;
	}

	public function InvoiceInfo($invoice)
	{
		$query = $this->mysqli("SELECT * FROM esut_payments WHERE id='$invoice'");
		$query = mysqli_fetch_object($query);
		return $query;
	}


	public function TranscriptInfo($id)
	{
		$query = $this->mysqli("SELECT * FROM esut_transcripts WHERE id='$id'");
		$query = mysqli_fetch_object($query);
		return $query;
	}


	public function PaymentInfoByAll($query)
	{
		$query = $this->mysqli("SELECT * FROM esut_payments WHERE id='$query' OR reference='$query' OR transcriptid='$query' OR verificationid='$query' ");
		$query = mysqli_fetch_object($query);
		return $query;
	}


	public function VerificationInfo($id)
	{
		$query = $this->mysqli("SELECT * FROM esut_verifications WHERE id='$id'");
		$query = mysqli_fetch_object($query);
		return $query;
	}


	public function ProfileScore($username)
	{
		$score = 0;
		$query = $this->mysqli("SELECT * FROM esut_accounts WHERE email='$username' OR accid='$username' OR vericode='$username'");
		$User = mysqli_fetch_object($query);
		if ($User->surname != "") {
			$score += 10;
		}
		if ($User->firstname != "") {
			$score += 10;
		}
		if ($User->middlename != "") {
			$score += 10;
		}
		if ($User->mobile != "") {
			$score += 10;
		}
		if ($User->sex != "") {
			$score += 10;
		}
		if ($User->address != "") {
			$score += 10;
		}
		if ($User->nationality != "") {
			$score += 10;
		}
		if ($User->dob_day != "") {
			$score += 10;
		}
		if ($User->dob_month != "") {
			$score += 10;
		}
		if ($User->dob_year != "") {
			$score += 10;
		}
		if ($User->dob != "") {
			$score += 10;
		}
		return $score;
	}


	public function setUserInfo($username, $keyname, $keyval)
	{
		$query = $this->mysqli("UPDATE esut_accounts SET `{$keyname}`='$keyval' WHERE email='$username' OR accid='$username' OR vericode='$username'");
		return (int)$this->countAffected();
	}

	public function LoadSessionAdmitted($session = "")
	{
		$html = '';
		$years = 2021;
		for ($i = 1981; $i < $years; $i++) {
			$numy = $i;
			$deny = ($i + 1);
			$fracy = "{$numy}/{$deny}";
			$checked = ($session == $fracy) ? "selected" : "";
			$html .= "<option {$checked} value=\"{$fracy}\">{$fracy}</option>";
		}
		return $html;
	}

	public function LoadCountries($countr_id = null)
	{
		$html = '';
		$countries = $this->mysqli("SELECT * FROM countries");
		while ($country = mysqli_fetch_object($countries)) {
			$selected = $country->id == $countr_id ? 'selected' : '';
			$html .= "<option value=\"{$country->id}\" {$selected}>{$country->name}</option>";
		}
		return $html;
	}


	public function LoadDobDay($day = null)
	{
		$html = '';
		$days = 32;
		for ($i = 1; $i < $days; ++$i) {
			$selected = $i == $day ? 'selected' : '';
			$ival = str_pad($i, 2, "0", STR_PAD_LEFT);
			$html .= "<option value=\"{$ival}\" {$selected}>{$ival}</option>";
		}
		return $html;
	}

	public function LoadDobMonth($month = null)
	{
		$html = '';
		$months = 13;
		for ($i = 1; $i < $months; ++$i) {
			$selected = $i == $month ? 'selected' : '';
			$ival = str_pad($i, 2, "0", STR_PAD_LEFT);
			$html .= "<option value=\"{$ival}\" {$selected}>{$ival}</option>";
		}
		return $html;
	}

	public function LoadDobYear($year = null)
	{
		$html = '';
		$years = 2020;
		for ($i = 1950; $i < $years; ++$i) {
			$selected = $i == $year ? 'selected' : '';
			$html .= "<option value=\"{$i}\" {$selected}>{$i}</option>";
		}
		return $html;
	}



	// Admin//

	public function adminListAccounts()
	{
		$query = $this->mysqli("SELECT * FROM esut_accounts ORDER BY accid DESC");
		return $query;
	}


	public function CountAccids()
	{
		$query = $this->mysqli("SELECT count(accid) AS ctx FROM esut_accounts");
		$query = mysqli_fetch_object($query);
		return (int)$query->ctx;
	}


	public function adminAccountsPageCount()
	{
		$row_count = $this->CountAccids();
		$page_count = (int)ceil($row_count / items_per_page);
		return $page_count;
	}


	public function adminListPagesAccounts($page = 1)
	{
		$row_count = $this->CountAccids();
		$items_per_page = items_per_page;
		$page_count = (int)ceil($row_count / $items_per_page);
		// double check that request page is in range
		if ($page > $page_count) {
			// error to user, maybe set page to 1
			$page = 1;
		}
		// set the number of items to display per page
		// build query
		$offset = ($page - 1) * $items_per_page;
		// $sql1 = "SELECT MAX(accid) as maxid, MAX(accid) as minid FROM esut_accounts ORDER BY accid DESC LIMIT {$offset},{$items_per_page}";
		$sql = "SELECT * FROM esut_accounts ORDER BY accid DESC LIMIT {$offset},{$items_per_page}";
		$query = $this->mysqli($sql);
		return $query;
	}

	public function PageLinks($page = 1)
	{
		$html = "";
		$page_count = $this->adminAccountsPageCount();
		for ($i = 1; $i <= $page_count; $i++) {
			if ($i === $page) { // this is current page
				$html .=  '<a class="btn btn-sm btn-success mx-1 my-1" href="/my/admin/accounts?pagenum=' . $i . '">Page ' . $i . '</a>';
			} else { // show link to other page
				$html .=  '<a class="btn btn-sm btn-info mx-1 my-1" href="/my/admin/accounts?pagenum=' . $i . '">Page ' . $i . '</a>';
			}
		}
		return $html;
	}


	public function adminListTranscripts()
	{
		$query = $this->mysqli("SELECT * FROM esut_transcripts ORDER BY created DESC");
		return $query;
	}


	public function adminListVerifications()
	{
		$query = $this->mysqli("SELECT * FROM esut_verifications ORDER BY created DESC");
		return $query;
	}


	public function adminListUserTranscripts($accid)
	{
		$query = $this->mysqli("SELECT * FROM esut_transcripts WHERE accid='$accid' ORDER BY id DESC");
		return $query;
	}

	public function adminListPayments($limit = 1000)
	{
		$query = $this->mysqli("SELECT * FROM esut_payments ORDER BY id DESC LIMIT 0,$limit");
		return $query;
	}


	// public function adminListPagesAccounts($page = 1)
	// {
	// 	$row_count = $this->CountAccids();
	// 	$items_per_page = items_per_page;
	// 	$page_count = (int)ceil($row_count / $items_per_page);
	// 	// double check that request page is in range
	// 	if ($page > $page_count) {
	// 		// error to user, maybe set page to 1
	// 		$page = 1;
	// 	}
	// 	// set the number of items to display per page
	// 	// build query
	// 	$offset = ($page - 1) * $items_per_page;
	// 	// $sql1 = "SELECT MAX(accid) as maxid, MAX(accid) as minid FROM esut_accounts ORDER BY accid DESC LIMIT {$offset},{$items_per_page}";
	// 	$sql = "SELECT * FROM esut_accounts ORDER BY accid DESC LIMIT {$offset},{$items_per_page}";
	// 	$query = $this->mysqli($sql);
	// 	return $query;
	// }




	public function adminListLimitedPayments($limit = 1000)
	{
		$query = $this->mysqli("SELECT * FROM esut_payments ORDER BY id DESC LIMIT '{$limit}'");
		return $query;
	}


	public function adminListSuccessfulPayments()
	{
		$query = $this->mysqli("SELECT * FROM esut_payments WHERE tranx_status_int='1' ORDER BY id DESC");
		return $query;
	}


	public function updaterListSuccessfulPayments()
	{
		$query = $this->mysqli("SELECT * FROM esut_payments WHERE tranx_status_int='1' ORDER BY id ASC");
		return $query;
	}

	public function adminListUserPayments($accid)
	{
		$query = $this->mysqli("SELECT * FROM esut_payments WHERE accid='$accid' ORDER BY created DESC");
		return $query;
	}




	public function userCountPayments($accid)
	{
		$query = $this->mysqli("SELECT COUNT(id) AS cntx FROM esut_payments WHERE accid='$accid'");
		$query = mysqli_fetch_object($query);
		return (int)$query->cntx;
	}

	public function userCountApplications($accid)
	{
		$query = $this->mysqli("SELECT COUNT(id) AS cntx FROM esut_transcripts WHERE accid='$accid'");
		$query = mysqli_fetch_object($query);
		return (int)$query->cntx;
	}
}
