<?php

namespace App\Http\Controllers\School;

use Exception;
use Carbon\Carbon;

use App\Models\User;
use App\Models\Subject;
use App\Models\BorrowBook;
use App\Models\LibBookType;
use Illuminate\Http\Request;
use App\Models\LibraryBookInfo;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class LibraryController extends Controller
{

    public function booksCreate()
    {   
        if(hasPermission('Book List Show')){
            $seoTitle = 'Book List';
            $seoDescription = 'Book List' ;
            $seoKeyword = 'Book List' ;
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            $allData = LibraryBookInfo::where('school_id', authUser()->id)->get();
            $bookType = LibBookType::where('school_id', authUser()->id)->get();
            $bookTypes =LibBookType::where('school_id', authUser()->id)->get();   
    
            return view('frontend.school.library.booksCreate', compact('bookType', 'bookTypes','allData','seo_array'));
        
        }
        else{
            return back();
        }
    }

    public function booksCreatePost(Request $request)
    {
        // return $request;

        // validate data
        $request->validate([
            'book_name' => 'required',
            'book_type_id' => 'required',
            'author_name' => 'required',
            'rack_no' => 'required',
            'quantity' => 'required',
            'available' => 'required',
        ]);
        $fileName = null;
        if ($request->hasFile('image')) {
            $fileName = time() . '.' . $request->file('image')->getclientOriginalExtension();
            $request->file('image')->move(public_path('/uploads/library'), $fileName);
        }

        
        // Create Book
        try {
            LibraryBookInfo::create(
                [
                    'book_name' => $request->book_name,
                    'book_type_id' => $request->book_type_id,
                    'author_name' => $request->author_name,
                    'rack_no' => $request->rack_no,
                    'quantity' => $request->quantity,
                    'available' => $request->available,
                    'image' => $fileName,
                    'school_id' => authUser()->id,
                ]
            );
            return back()->with('insert', 'data insert succesfully');;
        } 
        catch (\Exception $e) {
            return redirect()->route('books.create')->with('error', 'data insert failed');
        }
    }
    
    
    // Edit form
 
    public function booksEditPost(Request $request, $id)
    {
        if(hasPermission('book_list_edit')){
            $request->validate([
                'book_name' => 'required',
                'book_type_id' => 'required',
                'author_name' => 'required',
                'rack_no' => 'required',
                'quantity' => 'required',
            ]);
    
    
            $booksEditPost = LibraryBookInfo::find($id);
            // Edit image file
    
            $fileName = $booksEditPost->image;
            if ($request->hasFile('image')) {
                $removeFile = public_path() . '/uploads/library/' . $fileName;
                File::delete($removeFile);
                $fileName = date('Ymdhmsis') . '.' . $request->file('image')->getclientOriginalExtension();
                $request->file('image')->storeAs('/uploads/library/', $fileName);
            }
    
            try {
                $booksEditPost->update([
    
                    'book_name' => $request->book_name,
                    'book_type_id' => $request->book_type_id,
                    'author_name' => $request->author_name,
                    'rack_no' => $request->rack_no,
                    'quantity' => $request->quantity,
                    'image' => $fileName,
                    'school_id' => authUser()->id,
                ]);
                return redirect()->route('books.create');
            } catch (\Exception $e) {
                return redirect()->route('books.edit')->with('error', 'data insert failed');
            }
        }
        else{
            return back();
        }
        
    }

    public function booksDelete($id)
    {
        if(hasPermission('book_list_delete')){
            LibraryBookInfo::find($id)->delete();
            return back();
        }
        else{
            return back();
        }
        
    }

    public function books_Check_delete(Request $request)
    {
        if(hasPermission('book_list_delete')){
            $ids=$request->ids;
            LibraryBookInfo::whereIn('id',$ids)->delete();
            Alert::success('Selected books are deleted','success message');
            return response()->json(['status'=>'success']);
        }
        else{
            return back();
        }
    }

    public function booksType()
    {
        if(hasPermission('book_type_show')){
            return view('frontend.school.library.booksType');
        }
        else{
            return back();
        }
        
    }

    public function booksTypePost(Request $request)
    {
        $request->validate([
            'book_type' => 'required'
        ]);
        // for create new Bookcategory
        try {
            LibBookType::create([
                'book_type' => $request->book_type,
                'school_id' => authUser()->id,
            ]);
            return redirect()->route('books.create');
        } catch (\Exception $e) {
            return redirect()->route('books.type.create')->with('error', 'data insert failed');
        }
    }

    public function bookstypeDelete($id)
    {
        if(hasPermission('book_type_delete')){
            LibBookType::find($id)->delete();
            Alert::error('Opps!', "Record deleted");
    
            return back();
        }
        else{
            return back();
        }
        
    }


    public function pdeleteBooktype($id)
    {
        try {
            LibBookType::withTrashed()->where('id', $id)->forcedelete();
            
            $LibBookType = LibBookType::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json(['message' => 'Book type deleted parmanently',
                'data' => $LibBookType
            ]);
                            
        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Book type'], 500);
        }
       
    }

    public function restoreBookType($id)
    {
        try {
            LibBookType::withTrashed()->where('id', $id)->restore();
            
            $LibBookType = LibBookType::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json(['message' => 'Book type restored successfully',
                'data' => $LibBookType
            ]);
                            
        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Failed to restore Book type'], 500);
        }
    }

    public function pdeleteBook($id)
    {
        try {
            LibraryBookInfo::withTrashed()->where('id', $id)->forcedelete();
            
            $LibBooklist = LibraryBookInfo::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json(['message' => 'Book deleted parmanently',
                'data' => $LibBooklist
            ]);
                            
        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Failed to delete Book'], 500);
        }

        LibraryBookInfo::withTrashed()->where('id', $id)->forcedelete();
        toast("Data delete permanently", "success");
        return back();
    }
    
    public function restoreBook($id)
    {
        try {
            LibraryBookInfo::withTrashed()->where('id', $id)->restore();
            
            $LibBooklist = LibraryBookInfo::onlyTrashed()->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            return response()->json(['message' => 'Book restored successfully',
                'data' => $LibBooklist
            ]);
                            
        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Failed to restore Book'], 500);
        }
    }

    public function pdeleteBorrower($id)
    {
        try {
            BorrowBook::withTrashed()->where('id', $id)->forcedelete();
            
            $BorrowBook = BorrowBook::onlyTrashed()->with('studentRelation')->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            
            return response()->json(['message' => 'Borrower info deleted parmanently',
                'data' => $BorrowBook,
            ]);
                            
        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Failed to parmanent delete borrower info'], 500);
        }
    }

    public function restoreBorrower($id)
    {
        try {
            BorrowBook::withTrashed()->where('id', $id)->restore();
            
            $BorrowBook = BorrowBook::onlyTrashed()->with('studentRelation')->where('school_id', authUser()->id)->orderBy('deleted_at', 'desc')->get();
            
            return response()->json(['message' => 'Borrower info restored successfully',
                'data' => $BorrowBook,
            ]);
                            
        }
        catch (\Exception $e) {
            return response()->json(['error' => 'Failed to restore borrower info'], 500);
        }

    }

    //borrowrerController start

    public function borrowerinfo()
    {  
        if(hasPermission('borrower_info_show')) {
            $seoTitle = 'Borrower List';
            $seoDescription = 'Borrower List' ;
            $seoKeyword = 'Borrower List' ;
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            $borrowlist = BorrowBook::with('bookRelation', 'studentRelation')->where('school_id', authUser()->id)->where('return_date', Null)->orderBy('id', 'desc')->get();
            $borrowlist2 = BorrowBook::with('bookRelation', 'studentRelation')->where('school_id', authUser()->id)->where('return_date', '!=', Null)->orderBy('id', 'desc')->get();
            return view('frontend.school.library.borrowerPage', compact('borrowlist', 'borrowlist2', 'seo_array'));
        
        }
        else{
            return back();
        }
    }

    public function borrowerCreate()
    {   
        if(hasPermission('borrower_info_create')){
            $seoTitle = 'Borrower Add';
            $seoDescription = 'Borrower Add' ;
            $seoKeyword = 'Borrower Add' ;
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            $books = LibraryBookInfo::where('school_id', authUser()->id)->where('available', '>=', '1')->get();
            $students = User::where('school_id', authUser()->id)->get();
            $defaultDate = Carbon::today()->format('Y-m-d');
            return view('frontend.school.library.borroerCreate', compact('books', 'students', 'defaultDate','seo_array'));
        
        }
        else{
            return back();
        }
        }

    public function borrower_store(Request $request)
    {
        $request->validate([
            'book_id' => 'required',
            'student_id' => 'required',
            'borrow_date' => 'required',
            'possible_borrow_date' => 'required'
        ]);

        $book = LibraryBookInfo::find($request->book_id);
        $book->available -= 1;
        $book->save();
        try {
            BorrowBook::create([
                'book_id' => $request->book_id,
                'Student_id' => $request->student_id,
                'borrow_date' => $request->borrow_date,
                'return_date' => $request->return_date,
                'possible_borrow_date' => $request->possible_borrow_date,
                'school_id' => authUser()->id,
            ]);
            return redirect()->route('borrowerinfo')->with('insert', 'data has been insert successfully');
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }

    public function borrower_delete($id)
    {
        if(hasPermission('borrower_info_delete')){
            BorrowBook::find($id)->delete();
            return back();
        }
        else{
            return back();
        }
        
    }
    
    public function borrower_Edit($id)
    {   
        if(hasPermission('borrower_info_edit')){
            $seoTitle = 'Borrower Edit';
            $seoDescription = 'Borrower Edit' ;
            $seoKeyword = 'Borrower Edit' ;
            $seo_array = [
                'seoTitle' => $seoTitle,
                'seoKeyword' => $seoKeyword,
                'seoDescription' => $seoDescription,
            ];
            $books = LibraryBookInfo::where('school_id',authUser()->id)->get();
            $students = User::all();
            $borrowrer = BorrowBook::find($id);
            $defaultDate = Carbon::today()->format('Y-m-d');
            return view('frontend.school.library.borrowrerEdit', compact('books', 'students', 'borrowrer', 'defaultDate','seo_array'));
        
        }
        else
        {
            return back();
        }
    }
    public function borrower_Update(Request $request, $id)
    {
        // return $request;
        $request->validate([
            'borrow_date' => 'required',
        ]);
        $borrowrer = BorrowBook::find($id);
        if($request->has('return_date')){
            $return_date = $request->return_date;
        }
        else{
            $return_date = Null;
        }
        try {
            $borrowrer->update([
                'book_id' => $request->book_id,
                'Student_id' => $request->Student_id,
                'borrow_date' => $request->borrow_date,
                'return_date' => $return_date,                
                'possible_borrow_date' => $request->possible_borrow_date,
                'school_id' => authUser()->id,
            ]);
            if ($request->has('return_date')) {
                $book = LibraryBookInfo::find($request->book_id);
                $book->available += 1;
                $book->save();
            }
            return redirect()->route('borrowerinfo')->with('insert', 'data insert successfully');
        } catch (\Exception $e) {
            return redirect()->route('borrower.Edit', $id)->with('error', $e->getmessage());
        }
    }
}
