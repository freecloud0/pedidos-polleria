<?php

namespace App\Http\Controllers\Admin;

use App\Events\PromotionAdded;
use App\Events\PromotionDeleted;
use App\Http\Requests\PromotionRequest;
use App\Promotion;
use App\VueTables\EloquentVueTables;
use App\Http\Controllers\Controller;

class PromotionsController extends Controller
{
	public function index () {
		return view('admin.promotions.index');
	}

	public function json () {
		if(request()->ajax()) {
			$vueTables = new EloquentVueTables;
			$data = $vueTables->get(new Promotion, ['id', 'price', 'product_id'], ['product'], false);
			return response()->json($data);
		}
		abort(401);
	}

	public function create () {
		$btnText = 'Crear promoción';
		$route = route('admin.promotions_store');
		return view('admin.promotions.create', compact('btnText', 'route'));
	}

	/**
	 * @param PromotionRequest $promotionRequest
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store (PromotionRequest $promotionRequest) {
		$promotion = Promotion::create($promotionRequest->input());
		broadcast(new PromotionAdded($promotion))->toOthers();
		return back()->with('message', ['success', __('Promoción dada de alta correctamente')]);
	}

	public function delete (Promotion $promotion) {
		if (request()->ajax()) {
			try {
				broadcast(new PromotionDeleted($promotion->product_id))->toOthers();
				$promotion->delete();
				return response()->json(['res' => 'success']);
			} catch (\Exception $exception) {
				return response()->json(['res' => $exception->getMessage()], 400);
			}
		}
		abort(401, "Acceso denegado");
	}
}
