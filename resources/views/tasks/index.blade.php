@extends('layouts.task_layout')
@section('content')
    <div class="container p-4">
        <div class="card">
            <div class="card-header">
                <span style="font-weight: 500; font-size:22px;">Manage Tasks</span>
                <button id="addTask" class="btn btn-primary" style="float: right !important;">Add Task</button>
            </div>
            <div class="card-body">
                <table id="tasksTable" class="table table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Task Title</th>
                            <th>Asigned To</th>
                            <th>Deadline</th>
                            <th>Created At</th>
                            <th>Updated At</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>



    <!--Create Modal -->
    <div class="modal fade" id="createTaskModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <form id="createTask">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Add Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="task_title" class="form-label">Task Title</label>
                            <input type="text" name="task_title" id="task_title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="asign_to" class="form-label">Asigned To</label>
                            <input type="text" name="asign_to" id="asign_to" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" name="deadline" id="deadline" class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#createTaskModal">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


    <!--Edit Modal -->

    <div class="modal fade" id="editTaskModal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content p-3">
                <form id="editTask">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title">Edit Task</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                    </div>
                    <div class="modal-body">
                        <input type="hidden" name="id" id="id">
                        <div class="mb-3">
                            <label for="task_title" class="form-label">Task Title</label>
                            <input type="text" name="task_title" id="e_task_title" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="asign_to" class="form-label">Asigned To</label>
                            <input type="text" name="asign_to" id="e_asign_to" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label for="deadline" class="form-label">Deadline</label>
                            <input type="date" name="deadline" id="e_deadline" class="form-control" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" data-bs-toggle="modal"
                            data-bs-target="#editTaskModal">Update</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection
