
<div class="container page__container">
    <form action="./forms/my/transcript/apply" method="POST" class="p-0 mx-auto">
        <?= $Self->tokenize() ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="page-section">

                    <h2>Operational Logs & Dumps</h2>

                    <table id="MyDatatable" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>LOG ID</th>
                                <th>OPERATIONS</th>
                                <th>USER</th>
                                <th>DATE</th>
                                <th> - </th>
                            </tr>
                        </thead>

                        <tbody>

                        
                        </tbody>

                        <tfoot>
                            <tr>
                            <th>LOG ID</th>
                                <th>OPERATIONS</th>
                                <th>USER</th>
                                <th>DATE</th>
                                <th> - </th>
                            </tr>
                        </tfoot>
                    </table>



                </div>
            </div>
        </div>
    </form>
</div>