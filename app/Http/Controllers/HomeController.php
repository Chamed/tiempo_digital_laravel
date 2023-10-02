<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Booklist;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function show()
    {
        return view('home');
    }

    public function createList(Request $request) {
        $name = $request->input('name');
        $owner_id = intval($request->input('owner_id'));
        $description = $request->input('desc');
        $color = null;
        $is_system_deafault = false;

        Booklist::create([
            'name' => $name,
            'owner_id'=> $owner_id,
            'is_system_default' => $is_system_deafault,
            'color'=> $color,
            'description'=> $description,
        ]);

        return response()->json(['message' => 'Registro realizado', 'status' => 'success']);
    }
    public function getAllLists(Request $request)
    {
        $userId = $request->input('user_id');

        $lists = Booklist::where('owner_id', $userId)->get();

        return response()->json(['message' => 'Busca realizada com sucesso', 'status' => 'success', 'lists' => $lists]);
    }

    public function addBook(Request $request)
    {
        $title = $request->input('title');
        $synopsis = $request->input('synopsis');
        $stars = $request->input('stars');
        $author = $request->input('author');
        $cover_url = $request->input('cover_url');
        $lines_number = $request->input('lines_number');
        $list_id =$request->input('list_id');

        Book::create([
            'title' => $title,
            'synopsis' => $synopsis,
            'stars' => $stars,
            'author' => $author,
            'cover_url' => $cover_url,
            'lines_number' => $lines_number,
            'list_id' => $list_id,
        ]);

        return response()->json(['message' => 'Registro realizado', 'status' => 'success']);
    }

    public function alterBook(Request $request)
    {
        $book_id = $request->input('book_id');
        $list_id = $request->input('list_id');

        $book = Book::find($book_id);

        if (!$book) {
            return response()->json(['message' => 'Livro não encontrado', 'status' => 'error']);
        }

        $book->list_id = $list_id;

        $book->save();

        return response()->json(['message' => 'Registro atualizado', 'status' => 'success']);
    }

    public function deleteBook(Request $request)
    {
        $book_id = $request->input('book_id');

        $book = Book::find($book_id);

        if (!$book) {
            return response()->json(['message' => 'Livro não encontrado', 'status' => 'error']);
        }

        $book->delete();

        return response()->json(['message' => 'Registro excluído', 'status' => 'success']);
    }


    public function getAllBooks(Request $request)
    {
        $list_id = $request->input('list_id');

        $books = Book::where('list_id', $list_id)->get();

        return response()->json(['message' => 'Busca realizada com sucesso', 'status' => 'success', 'books' => $books]);
    }

}
