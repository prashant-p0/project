

<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Query</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="editdeletethreadlist.php" method="POST">
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="loginEmail" class="form-label">Problem Title</label>
                
                        <input type="hidden" class="form-control" value="<?php echo $cat_id2 ?> " id="problem" name="catid" aria-describedby="emailHelp">
                        <input type="hidden" class="form-control th-id" value="<?php echo $id ?>" id="problem" name="id" aria-describedby="emailHelp">
                        <input type="text" class="form-control"  id="problem" name="problem" aria-describedby="emailHelp"  required>
                    </div>
                    
                    <div class="form-group mb-3">
                        <label for="exampleFormcontrolTextarea1">Elaborate Your Concern</label>
                        <textarea class="form-control" id="desc"  name="desc" rows="3" required></textarea>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Save Changes</button>

                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>