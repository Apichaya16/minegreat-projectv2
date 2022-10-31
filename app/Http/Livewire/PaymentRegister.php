<?php

namespace App\Http\Livewire;

use App\Models\Account;
use App\Models\Brand;
use App\Models\InstallmentType;
use App\Models\PaymentType;
use App\Models\ProductDetail;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PaymentRegister extends Component
{
    protected $listeners = ['submitForm'];

    public $currentStep = 1;
    public $brandProduct, $modelProduct, $modelName, $colorProduct, $colorName, $capacityProduct, $capacityName, $installmentType, $paymentType, $price, $installment, $balance;

    public function render()
    {
        $brands = Brand::where('is_active', 1)->get();
        $installmentTypes = InstallmentType::where('is_active', 1)->get();
        $paymentTypes = PaymentType::where('is_active', 1)->get();
        return view('livewire.payment-register-form', compact(['brands', 'installmentTypes', 'paymentTypes']));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function firstStepSubmit()
    {
        $this->validate([
            'brandProduct' => 'required',
            'modelProduct' => 'required',
            'colorProduct' => 'required',
            'capacityProduct' => 'required'
        ]);

        $detail = ProductDetail::where('color', $this->colorProduct)->where('capacity', $this->capacityProduct)->with(['products', 'colors', 'capacities'])->first();
        $this->modelName = $detail->products->name_en;
        $this->colorName = $detail->colors->name_th;
        $this->capacityName = $detail->capacities->size;
        $this->price = $detail->products->price;

        $this->currentStep = 2;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function secondStepSubmit()
    {
        $this->validate([
            'installmentType' => 'required',
            'paymentType' => 'required',
            'installment' => 'required'
        ]);

        $this->currentStep = 3;
    }

    public function showConfirm()
    {
        $this->dispatchBrowserEvent('swal:confirm', [
            'title' => 'ยืนยันการทำรายการ',
            'icon'=>'warning',
        ]);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function submitForm()
    {
        try {
            DB::beginTransaction();

            Account::create([
                'user_id' => auth()->user()->u_id,
                'brand' => $this->brandProduct,
                'product' => $this->modelProduct,
                'type' => $this->installmentType,
                'price' => $this->price,
                // 'discount' => $this->price,
                'amount_after_discount' => $this->price,
                // 'amount_consider',
                'installment' => $this->installment,
                'type_pay' => $this->paymentType,
                'status_type' => 9,
                'balance_payment' => $this->balance,
                // 'percen_current' => $this->paymentType,
                // 'percen_consider' => $this->paymentType,
                // 'detail_promotion' => $this->paymentType
            ]);

            $this->dispatchBrowserEvent('swal:toast', [
                'title' => 'ทำรายการสำเร็จ',
                'timer'=>3000,
                'timerProgressBar' => true,
                'icon'=>'success',
                'toast'=>true,
                'position'=>'top-right',
                'showConfirmButton' => false,
            ]);

            DB::commit();
        } catch (\Throwable $th) {
            DB::rollBack();
            throw $th;
        }
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function back($step)
    {
        $this->currentStep = $step;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function clearForm()
    {
        $this->brandProduct = '';
        $this->modelProduct = '';
        $this->modelName = '';
        $this->colorProduct = '';
        $this->colorName = '';
        $this->capacityProduct = '';
        $this->capacityName = '';
        $this->installmentType = '';
        $this->paymentType = '';
        $this->price = '';
        $this->installment = '';
        $this->balance = '';
    }
}
