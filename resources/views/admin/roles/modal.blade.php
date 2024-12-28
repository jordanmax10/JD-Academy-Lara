<div class="modal face" id="modal-delete-{{ $role->id}}">
    <div class="modal-dialog">
        <form action="{{ route('admin-role.destroy', $role->id) }}" method="POST">
            @csrf
            @method('DELETE')
            <div class="modal-content bg-secondary">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar Rol</h4>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Deseas Eliminar el Rol :  {{  $role->name }}</p>
                </div>
                <div class="modal-footer justify-content-between">
                    <button class="btn btn-outline-light" type="button" data-dismiss="modal">Cerrar</button>
                    <button class="btn btn-outline-light" type="submit">Eliminar</button>
                </div>
            </div>
        </form>
    </div>
</div>
