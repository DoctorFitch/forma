<?php require_once("inc/init.php"); ?>

<button type="button" class="well" onclick="ouverture_associations_ajout();"><i class="fa fa-plus-square"></i>&nbsp;&nbsp;Créer
    une association
</button>

<!-- Container datatable -->
<div class="row">
    <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-editbutton="false"
             data-widget-fullscreenbutton="false">

            <header>
                <span class="widget-icon">
                    <i class="fa fa-building"></i>
                </span>
                <h2>Associations</h2>
            </header>

            <!-- debut widget-->
            <div>
                <div class="jarviswidget-editbox">
                </div>

                <!-- contenu widget -->
                <div class="widget-body no-padding">
                    <form id="tableau">
                        <table id="listing_associations" class="table table-striped table-bordered table-hover"
                               width="100%">
                            <thead>
                            <tr>
                                <th>Nom</th>
                                <th>ICOM</th>
                                <th>E-mail</th>
                                <th>Date d'inscription</th>
                                <th></th>
                            </tr>
                            </thead>
                        </table>
                    </form>
                </div>
                <!-- fin contenu widget -->
            </div>
            <!-- fin widget -->
        </div>
    </article>
</div>
<!-- fin container-->

<!-- modal ajout association-->
<div class="modal fade" id="associations_ajout" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        </div>
    </div>
</div>
<!-- fin modal ajout -->

<!-- modal modification association -->
<div class="modal fade" id="associations_modification" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        </div>
    </div>
</div> <!-- fin modal modification -->

<script type="text/javascript">

    $(document).ready(function () {

        pageSetUp();

        var pagefunction = function () {

            localStorage.clear();

            var responsiveHelper_listing_associations = undefined;

            var breakpointDefinition = {
                tablet: 1024,
                phone: 480
            };

            $('#listing_associations').dataTable({
                "sDom": "<'dt-toolbar'<'col-xs-12 col-sm-6'f><'col-sm-6 col-xs-6 hidden-xs'T>r>" +
                "t" +
                "<'dt-toolbar-footer'<'col-sm-6 col-xs-12 hidden-xs'i><'col-sm-6 col-xs-12'p>>",
                "oTableTools": {
                    "aButtons": [
                        "xls",
                        {
                            "sExtends": "print",
                            "sMessage": "Généré par Forma <i>(Appuyez sur Echap pour fermer)</i>"
                        }
                    ],
                    "sSwfPath": "assets/js/plugin/datatables/swf/copy_csv_xls_pdf.swf"
                },
                "autoWidth": true,
                "preDrawCallback": function () {
                    if (!responsiveHelper_listing_associations) {
                        responsiveHelper_listing_associations = new ResponsiveDatatablesHelper($('#listing_associations'), breakpointDefinition);
                    }
                },
                "rowCallback": function (nRow) {
                    responsiveHelper_listing_associations.createExpandIcon(nRow);
                },
                "ajax": "modules/associations/ajax/iAssociation_listing.php",
                "drawCallback": function (oSettings) {
                    responsiveHelper_listing_associations.respond();
                },
                "language": {
                    "url": "./data/traduction_datatables_fr.json"
                }
            });

        };

        loadScript("assets/js/plugin/datatables/jquery.dataTables.min.js", function () {
            loadScript("assets/js/plugin/datatables/dataTables.colVis.min.js", function () {
                loadScript("assets/js/plugin/datatables/dataTables.tableTools.min.js", function () {
                    loadScript("assets/js/plugin/datatables/dataTables.bootstrap.min.js", function () {
                        loadScript("assets/js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction)
                    });
                });
            });
        });

    });

    function ouverture_associations_ajout() {
        $.ajax({
            url: 'modules/associations/modal/modal_associations_ajout.php',
            type: 'POST',
            data: '',
            dataType: 'html',
            success: function (contenu) {
                $('#associations_ajout .modal-content').html(contenu);
                $('#associations_ajout').modal('show');
            },
            error: function () {
                alert('erreur lors du retour JSON !');
            }
        });
    }

    function ouverture_associations_modification(associations_id) {
        $.ajax({
            url: 'modules/associations/modal/modal_associations_modification.php',
            type: 'POST',
            data: {"associations_id" : associations_id},
            dataType: 'html',
            success: function (contenu) {
                $('#associations_modification .modal-content').html(contenu);
                $('#associations_modification').modal('show');
            },
            error: function () {
                alert('erreur lors du retour JSON !');
            }
        });
    }

    function suppressionLigne(paramId) {
        $.SmartMessageBox({
            title: "Attention !",
            content: "Vous êtes sur le point de supprimer cette association, confirmer ?",
            buttons: '[Non][Oui]'
        }, function (ButtonPressed) {
            if (ButtonPressed === "Oui") {
                $.ajax({
                    url: 'modules/associations/ajax/iAssociation_suppression.php',
                    type: 'POST',
                    data: {'id': paramId},
                    dataType: 'html',
                    success: function (contenu) {
                        smallBox('Suppression', "L'association à correctement été supprimée.", 'success');
                    },
                    error: function () {
                        smallBox('Erreur', 'Une erreur est survenu dans la fonction suppressionLigne(paramId).', 'warning');
                    }
                });
            }
            if (ButtonPressed === "Non") {
                smallBox('Suppression', "L'association n'a pas été supprimée.", 'warning');
            }
        });
    }

</script>