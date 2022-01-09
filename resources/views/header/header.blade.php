<!-- Alerts Modal -->
<div class="modal modal-nobg centered fade" id="alertsModal" tabindex="-1" role="dialog" aria-label="Alerts" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="alert alert-danger alert-dismissible fade show border-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> Security SW update available
                </div>
                <div class="alert alert-warning alert-dismissible fade show border-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> New device recognized
                </div>
                <div class="alert alert-warning alert-dismissible fade show border-0" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> User profile is not complete
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>

<!-- Arming Modal -->
<div class="modal modal-warning centered fade" id="armModal" tabindex="-1" role="dialog" aria-label="Arming" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div id="armTimer">
                    <h3 class="font-weight-bold">EXIT NOW! <span class="timer font-weight-normal"></span></h3>
                </div>
            </div>
        </div>
    </div>
    <button type="button" class="close close-modal" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>