

<body>


<nav class="navbar bg-sekundærfarve">
    <div class="container-fluid">
        <div class="row w-100">
            <div class="col-1"></div>

            <div class="col-10">
                <div class="d-flex justify-content-between display-3 brødtekst">
                    <div class="">
                        <a href="forside.php" ><img src="#" alt="" class="img-fluid">Logo</a>
                    </div>

                    <div class="ms-auto">
                        <a href="#" class="" data-bs-toggle="modal" data-bs-target="#sprogModal">
                            <img src="img/globus.webp" alt="" class="img-fluid col-1 " style="width: 50px">
                        </a>
                        <a href="Indkøbskurv.php" class="ms-4 position-relative">
                            <img src="img/Indkøbskurv.webp" alt="Indkøbskurv" class="img-fluid col-1" style="width: 50px">
                            <span id="cart-badge" class="position-absolute top-25 start-100 translate-middle badge bg-baggrundsfarve rounded-circle">
                               <span class="visually-hidden">
                             </span>
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
