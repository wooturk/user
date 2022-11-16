<?php

namespace Wooturk;
use App\Http\Controllers\Controller;
use Google\Exception;
use Illuminate\Http\Request;

class CountryController extends Controller
{
	function index(Request $request){
		return Response::success("Lütfen Giriş Yapınız");
	}
	function list(Request $request){
		if($rows = get_cusers( $request->all() )){
			return Response::success("Kullanıcı Bilgileri", $rows);
		}
		return Response::failure("Kullanıcı Bulunamadı");
	}
	function get(Request $request, $id){
		if($row = get_user($id)){
			return Response::success("Kullanıcı Bilgileri", $row);
		}
		return Response::failure("Kullanıcı Bulunamadı");
	}
	function post(Request $request) {
		$exception = '';
		try {
			$fields = $request->validate([
				'name'       => 'required|string|max:255',
				'code'       => 'required|string|max:32|unique:countries',
				'state'      => 'required|boolean'
			]);
			$row = create_user($fields);
			if($row){
				return Response::success("Kullanıcı Oluşturuldu", $row);
			}
			return Response::failure("Kullanıcı Oluşturulamadı");
		} catch(\Illuminate\Database\QueryException $ex){
			$exception = $ex->getMessage();
		} catch (Exception $ex){
			$exception = $ex->getMessage();
		}
		return Response::exception( $exception);
	}
	function put(Request $request, $id){
		$exception = '';
		try {
			$fields = $request->validate([
				'name'       => 'required|string|max:255',
				'code'       => 'required|string|max:32|unique:brands',
				'sort_order' => 'required|integer',
				'state'      => 'required|boolean'
			]);
			$row = update_user($id, $fields);
			if($row){
				return Response::success("Kullanıcı Güncellendi", $row);
			}
			return Response::failure("Kullanıcı Güncellenemedi");
		} catch(\Illuminate\Database\QueryException $ex){
			$exception = $ex->getMessage();
		} catch (Exception $ex){
			$exception = $ex->getMessage();
		}
		return Response::exception( '$exception');
	}
	function delete(Request $request, $id){
		$exception = '';
		try {
			if( $row = delete_user($id)){
				return Response::success("Kullanıcı Silindi", $row);
			}
			return Response::failure("Kullanıcı Bulunamadı");
		} catch(\Illuminate\Database\QueryException $ex){
			$exception = $ex->getMessage();
		} catch (Exception $ex){
			$exception = $ex->getMessage();
		}
		return Response::exception( $exception);
	}
}
