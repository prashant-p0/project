
<!-- Modal -->
<div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel">Update Comment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="update.php" method="POST">
                <div class="modal-body">

                  
                    
                    <div class="form-group mb-3">
                    <input type="hidden" class="form-control" value="<?php echo $thread_id2 ?>" id="problem" name="catid" aria-describedby="emailHelp">
                        <input type="hidden" class="form-control" value="<?php echo $id ?>" id="problem" name="id" aria-describedby="emailHelp">
                        <label for="exampleFormcontrolTextarea1">Submit Your Comment</label>
                    
                        <textarea class="form-control" id="desc"  name="desc" rows="3" required><?php echo $content ?></textarea>
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Submit</button>

                </div>
                <div class="modal-footer">
                    <button type="button"  class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>