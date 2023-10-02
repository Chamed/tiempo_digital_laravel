<!DOCTYPE html>
<html lang="pt-BR" data-bs-theme="dark">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="{{ asset('js/home.js') }}" type="module"></script>
    <script src="{{ asset('js/book.js') }}" type="module"></script>
    <script src="{{ asset('js/list.js') }}" type="module"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/blueimp-md5/2.18.0/js/md5.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('css/global.css') }}">


    <script src="https://code.jquery.com/jquery-3.6.3.js"
      integrity="sha256-nQLuAZGRRcILA+6dMBOvcRh5Pe310sBpanc6+QBmyVM=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
      crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
  </head>

  <div>
    <div id="toast" class="toast bg-success text-white top-0 end-0 m-3" role="alert" aria-live="assertive"
      aria-atomic="true" data-bs-dismiss="toast">
      <div id="toastMessage" class="toast-body">
      </div>
    </div>
    <div class="d-flex background">
      <div id="menu" class="menu d-flex flex-column">
        <div class="d-flex flex-column">
          <div class="dropdown">
            <div class="user-container d-flex" data-bs-toggle="dropdown"
              style="background-color: #5E5D6F; margin: 10px; border-radius: 10px; overflow: hidden;">
              <div class="d-flex flex-row align-items-center" style="margin: 15px;">
                <div class="d-flex">
                  <img id="gravatar" class="img-fluid" src="" alt="Foto de perfil">
                </div>
                <div id="username" class="child"></div>
              </div>
            </div>
            <ul class="dropdown-menu dropdown-menu-dark">
              <li id="logout"><a class="dropdown-item">Sair</a></li>
            </ul>
          </div>
          <hr class="divider">
        </div>
      </div>
      <div class="container m-3" style="height: 100vh; width: 100%; overflow: auto">
        <button id="searchBook" type="button" class="btn btn-primary">
          Buscar livro
        </button>
        <button id="createList" type="button" class="btn btn-secondary">
          Criar lista de leitura
        </button>
        <div class="list-info">
          <h1 id="listName"></h1>
          <span id="ListDescription"></span>
          <hr class="divider">
        </div>
        <div id="bookList" class="book-list">
        </div>
      </div>
    </div>
    <div id="bookModal" class="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Buscar livro</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <div class="d-flex flex-row">
              <input id="bookInput" type="text" class="form-control" placeholder="Digite um livro para buscar...">
              <input id="searchBookModal" class="btn btn-primary" type="button" style="margin-left: 10px;"
                value="Buscar Livro" disabled>
            </div>
            <div class="loading-book-data justify-content-center hidden" style="display: flex; margin: 50px 0px 50px">
              <img src="https://media.tenor.com/On7kvXhzml4AAAAj/loading-gif.gif" alt="">
            </div>
            <div class="hidden book-data">
              <div class="book-info" style="margin-top: 15px;">
                <div class="d-flex flex-row">
                  <div style="margin-right: 50px;">
                    <img src="" alt="Capa livro" class="book-thumb">
                  </div>
                  <div class="d-flex flex-column">
                    <form id='bookForm'>
                     @csrf
                    </form>
                    <span id="bookTitle">Titulo</span>
                    <span id="bookAuthor">Author</span>
                    <span id="bookPages">Pages</span>
                    <p id="synopsis"> Sinopse</p>
                  </div>
                </div>
              </div>
              <div class="d-flex flex-row" style="margin: 30px 0px 40px;">
                <label for="listSelect"> Selecione uma lista para adicionar o livro</label>
                <select id="listSelect" class="form-select" aria-label="Listas">
                </select>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button id="addBook" type="button" class="btn btn-primary">Adicionar Livro</button>
          </div>
        </div>
      </div>
    </div>

    <div id="createListModal" class="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Criar lista de leitura</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id="listForm">
                @csrf
              <div class="form-group mb-3">
                <label for="listNameInput">Nome</label>
                <input id="listNameInput" type="text" class="form-control" placeholder="Digite o nome da lista">
                <div id="nameErrorMessage" class="invalid-feedback"></div>
              </div>
              <div class="form-group mb-3">
                <label for="listDesc">Descrição</label>
                <textarea id="listDesc" class="form-control" rows="3" placeholder="Digite uma descrição"></textarea>
                <div id="descErrorMessage" class="invalid-feedback"></div>
              </div>
              <!-- <div class="form-group mb-3">
                <label for="listParent">Lista Pai</label>
                <select class="form-control" id="listParent">
                  <option value="">Selecione uma lista</option>
                  <option value="lista1">Lista 1</option>
                  <option value="lista2">Lista 2</option>
                  <option value="lista3">Lista 3</option>
                </select>
              </div> -->
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button id="createListSubmit" type="button" class="btn btn-primary">Criar lista de leitura</button>
          </div>
        </div>
      </div>
    </div>

    <div id="changeListModal" class="modal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">Mudar livro de lista</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form id='alterBook'>
                @csrf
                <label for="destinyList">Lista de destino:</label>
                <select class="form-control" id="destinyList">
                </select>
            </form>
          </div>
          </form>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
            <button id="changeBookList" type="button" class="btn btn-primary">Confirmar</button>
          </div>
        </div>
      </div>
    </div>

    <form id='deleteBookForm'>
        @csrf
    </form>
  </div>
  </body>

</html>
