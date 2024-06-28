@extends('layouts.admin') 

@section('content')
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <h1 class="mt-2">Lista Progetti</h1>
                <span class="fs-4 add-btn d-flex align-items-center justify-content-center text-white me-5"><a href="{{ route("admin.projects.create") }}"><i class="fa-solid fa-plus"></i></a></span>
            </div>
            <div class="d-flex justify-content-between align-items-center">
                <p>Clicca il nome per avere maggiori informazioni</p>
                <p class="me-1">Aggiungi progetto</p>
            </div>

            @if (session("messageDelete"))
                <div class="alert alert-success">
                    {{ session("messageDelete") }}
                </div>
            @endif

            @if (session("messageUpload"))
                <div class="alert alert-primary">
                    {{ session("messageUpload") }}
                </div>
            @endif

            @if (session("messageEdit"))
                <div class="alert alert-primary">
                    {{ session("messageEdit") }}
                </div>
            @endif

            <table class="table table-striped table-hove ms-body" >
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($projects as $project)
                        <tr>
                            <th scope="row">{{ $project->id }}</th>
                            <td><a href="{{ route("admin.projects.show", ["project" => $project->slug]) }}">{{ $project->title }}</a></td>
                            <td>{{ $project->description }}</td>
                            {{-- <td><a class="btn btn-primary" href="{{ route ("admin.projects.edit", ["project" => $project->slug])}}">Modifica</a></td> --}}
                            <td>
                                <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $project->id }}">Elimina</button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Modale Eliminazione -->
            <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModal" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        {{-- HEADEAR --}}
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Conferma eliminazione</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        {{-- BODY --}}
                        <div class="modal-body">
                            <span>Vuoi davvero eliminare l'elemento definitivamente?</span>
                        </div>
                        {{-- FOOTER --}}
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-danger" data-bs-dismiss="modal">Chiudi</button>
                            {{-- DESTROY --}}
                            <form id="deleteForm" action="" method="POST">
                                @method("DELETE")
                                @csrf
                                <button class="btn btn-danger">Elimina definitivamente</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var deleteModal = document.getElementById('deleteModal');
                deleteModal.addEventListener('show.bs.modal', function (event) {
                    var button = event.relatedTarget;
                    var projectId = button.getAttribute('data-id');
                    var form = document.getElementById('deleteForm');
                    form.action = '/admin/projects/' + projectId;
                });
            });
        </script>
@endsection
