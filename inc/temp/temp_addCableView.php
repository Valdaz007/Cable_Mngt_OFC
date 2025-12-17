<div class="add_Cable_Form" id="addPoleForm">
    <h6>Cable Installation</h6>
    <div class="form-floating">
        <input type="text" name="desc" class="form-control mb-2" id="cable-desc">
        <label for="cable-desc">Cable Description</label>
    </div>
    <div class="form-floating">
        <input type="text" name="core" class="form-control mb-2" id="cable-core">
        <label for="cable-core">Cable Core</label>
    </div>
    <div class="form-floating">
        <input type="text" name="type" class="form-control mb-2" id="cable-type">
        <label for="cable-type">Cable Run Type</label>
    </div>
    <button class="btn btn-primary" onclick="addCableDB()">Add Cable</button>
    <button class="btn btn-warning" onclick="openCableVw()">Close</button>
</div>

<style>
    .add_Cable_Form {
        display: none;

        width: 450px;
        padding: 1rem;

        background-color: orange;
        border-radius: .5rem;

        position: absolute;
        top: 3rem;
        left: 3rem;

        z-index: 9999;
    }
</style>