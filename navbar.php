

<body>


<nav class="navbar bg-sekundærfarve">
    <div class="container-fluid">
        <div class="row w-100">
            <div class="col-1"></div>

            <div class="col-10">
                <div class="d-flex justify-content-between display-3 brødtekst">
                    <div class="">
                        <a href="#" class="d-flex">
                            <img src="#" alt="" class="img-fluid"> Logo
                        </a>
                    </div>

                    <div class="d-flex align-items-center">
                        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#sprogModal">
                            <img src="img/Indkøbskurv.webp" alt="" class="img-fluid col-1">
                        </a>
                        <a href="#" class="ms-4">
                            <img src="#" alt="" class="img-fluid"> Kurv
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-1"></div>
        </div>
    </div>
</nav>


<div class="modal fade" id="sprogModal" tabindex="-1" aria-labelledby="sprogModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-outlinefarve ">

            <div class="modal-header">
                <h5 class="modal-title" id="sprogModalLabel"></h5>
                <button type="button" class="btn-close btn-close-primærfarve lukkeknap" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
                <p class="fs-2 text-primærtekstfarve brødtekst">Hvilket sprog foretrækker du?</p>
                <div class="form-check">
                    <input class="form-check-input form-check-input" type="radio" name="sprog" id="dansk" value="dansk" checked>
                    <label class="form-check-label ms-2" for="dansk">Dansk</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sprog" id="english" value="english">
                    <label class="form-check-label ms-2" for="english">English</label>
                </div>
                <div class="form-check">
                    <input class="form-check-input" type="radio" name="sprog" id="deutsch" value="deutsch">
                    <label class="form-check-label ms-2" for="deutsch">Deutsch</label>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary me-3 btn-lg rounded-pill btn-sekundærknap text-primærtekstfarve border-outlinefarve" data-bs-dismiss="modal" style="width: 150px;">Annuller</button>
                <button type="button" class="btn btn-primary btn-lg rounded-pill btn-primærknap " data-bs-dismiss="modal" style="width: 150px;">Gem</button>
            </div>

        </div>
    </div>
</div>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
</body>
