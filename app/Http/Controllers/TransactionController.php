<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use function PHPUnit\Framework\isEmpty;

class TransactionController extends Controller
{
    public function index(){
        $transaction = Transaction::with('user', 'book')->get();

        if ($transaction->isEmpty()){
            return response()->json([
                'success' => false,
                'message' => 'No transaction found'
            ], 200);
        }

        return response()->json([
            'success' => true,
            'message' => 'get all transaction',
            'data' => $transaction
        ]);
    }

    public function store(Request $request){
        //1. validator dan cek
        $validator = Validator::make($request->all(),[
            'book_id' => 'required|exists:book,id',
            'quantity' => 'required|integer|min:1'
        ]);
        if ($validator-> fails()){
            return response()->json([
                'success' => false,
                'message' => 'validator eror',
                'data' => $validator->errors()
            ], 400);
        }
        //2. generate order number -> unique 
        $uniqueOrderNumber = 'ORD-'. strtoupper(uniqid());

        //3. ambil user yang sedang login dan cek login (cek data)
        $user =auth('api')->user();

        if (!$user){
            return response()->json([
                'success' => false,
                'message' => 'user not failed'
            ], 401);
        }
        //4. mencari data buku
        $book = Book::find($request->book_id);

        //5. cek stok buku
        if ($book->stock < $request->quantity){
            return response()->json([
                'success' => false,
                'message' => 'stok buku tidak cukup'
            ], 400);
        }
        //6. hitung total harga
        $totalAmount = $book->price * $request->quantity;

        //7. kurangi stok buku
        $book->stock -= $request->quantity;
        $book->save();

        //8. simpan data transaksi
        $transaction = Transaction::create([
            'order_number' => $uniqueOrderNumber,
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'quantity' => $request->quantity,
            'total_amount' => $totalAmount
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'transaction successfully',
            'data' => $transaction
        ], 201);
    }

    // show
    public function show(string $id){
        $transaction = Transaction::find($id);

        if (!$transaction){
            return response()->json([
                "success" => false,
                "messege" => "resource not found",
            ]);
        }
        return response()->json([
            "success" => true,
            "messege" => "get detail resource",
            "data" => $transaction
        ]);
    }

    //update
    public function update(string $id, Request $request){
        //mencari data
        $transaction = Transaction::find($id);
        if (! $transaction){
            return response()->json([
                "success" => false,
                "messege" => "resourse not found"
            ], 404);
        }
        // 2 validator
        $validator = Validator::make($request->all(),[
            'book_id' => 'required|exists:book,id',
            'quantity' => 'required|integer|min:1'
        ]);
        if ($validator->fails()) {
            return response()->json([
            "success" => false,
            "message" => $validator->errors()
        ], 422);
        }
        //3 siapkan data yang mau diupdate
        $data= [
            'book_id' => $request->book_id,
            'quantity' => $request->quantity,
        ];

        //5. update data
        $transaction->update($data);
        return response()->json([
            "success" => true,
            "messege" => "resourse updated successfully",
            "data" => $data
        ]);
    }

    //delete
    public function destroy(string $id){
        $transaction = Transaction::find($id);
        if (!$transaction){
            return response()->json([
                "success" => true,
                "messege" => "resourse not found",
            ]);
        }
        $transaction ->delete();
        return response()->json([
            "success" => true,
            "messege" => "resourse deleted successfully",
        ]);
        }
}
