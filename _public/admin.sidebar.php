<div class="xxl:pl-6 grid grid-cols-12 gap-6">
    <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-3 xxl:mt-3">

        <div class="grid grid-cols-12 mt-2">
            <div class="col-span-12 sm:col-span-12 xl:col-span-12 intro-y">
                <div class="report-box zoom-in">
                    <div class="box p-5">
                        <div class="flex">
                            <i data-feather="send" class="report-box__icon text-theme-10"></i>
                            <div class="ml-auto">
                                <a href="#" class="text-link">buy sms credit </a>
                            </div>
                        </div>
                        <div class="text-3xl font-bold leading-8 mt-6"><?= $Core->Monify($UserInfo->balance) ?></div>
                        <div class="text-base text-gray-600 mt-1">SMS Balance</div>
                    </div>
                </div>
            </div>
        </div>
        <!-- BEGIN: Transactions -->
        <div class="col-span-12 md:col-span-6 xl:col-span-4 xxl:col-span-12 mt-4 xxl:mt-3">
            <div class="intro-x flex items-center h-10">
                <h2 class="text-lg font-medium truncate mr-5">
                    Other Agents: <strong class="text-theme-10"><?= $Core->CountUsers()->ousers ?></strong> / <strong class="text-theme-6"><?= $Core->CountUsers()->nusers ?></strong>
                </h2>
            </div>
            <div class="mt-5">

                <?php while ($agent = mysqli_fetch_object($Agents)) : ?>
                    <a class="intro-x" href="/dashboard/agents/<?= $agent->accid ?>/manage">
                        <div class="box px-5 py-3 mb-3 flex items-center zoom-in" style="<?= ($agent->enabled) ? '' : 'border:2px solid #FF005A' ?>">
                            <div class="w-10 h-10 flex-none image-fit rounded-full overflow-hidden">
                                <img src="<?= $assets ?>images\profile-8.jpg">
                            </div>
                            <div class="ml-4 mr-auto">
                                <div class="font-medium"><?= $agent->fullname ?></div>
                                <div class="text-gray-600 text-xs">seen: <?= $agent->lastseen ?></div>
                            </div>
                            <div class="text-theme-10"><?= $Core->Monify($agent->credit) ?></div>
                        </div>
                    </a>
                <?php endwhile; ?>


                <a href="/dashboard/accounts" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-theme-15 dark:border-dark-5 text-theme-16 dark:text-gray-600">Manage Clients & Users</a>


            </div>
        </div>

    </div>