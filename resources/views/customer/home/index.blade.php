@extends('customer.layouts.customer')

@section('content')
<div class="container">
    <div class="text-center">
        <img src="https://kb.hostatom.com/wp-content/uploads/2021/10/750x350bannersize2021-2.jpg" alt="">
    </div>

    <hr>

    <p class="h5">
        ไม่ได้มีแต่ “ผัดไทย” หรือ “ต้มยำ” ที่เป็นอาหารประจำชาติขึ้นชื่อของไทย หารู้ไม่ว่าจานด่วนอย่าง “ผัดกะเพรา” ต่างหากที่คนท้องถิ่นเรียกหาไม่ว่าจะมื้อไหน ๆ ด้วยรสชาติที่แสนอร่อย เผ็ดร้อน หอมกรุ่นใบกะเพรา และใช้เวลาทำไม่นาน เมื่อตักราดข้าวสวยคดร้อน ๆ โปะด้วยไข่ดาวสักฟอง แค่นี้ก็ชวนให้คนหิวยิ้มแก้มปริ
        “ผัดกะเพราที่เสิร์ฟที่ร้านเป็นผัดกะเพราที่ผมชอบที่สุด และส่วนตัวเป็นคนชอบกินผัดกะเพราแบบนี้ครับ แม้อาจจะไม่ถูกปากทุกคน แต่รับรองว่าไม่เหมือนใครในโลกแน่นอน” เชฟต้น-ธิติฏฐ์ ทัศนาขจร แห่งร้านบ้าน (รางวัลมิชลินเพลท มิชลิน ไกด์ ประเทศไทย ฉบับประจำปี 2563) ร้านอาหารไทยสไตล์ครอบครัวที่เป็นน้องเล็กของร้าน Le Du (รางวัลหนึ่งดาวมิชลิน) บอกถึงผัดกะเพราของเขาอย่างมั่นใจ
    </p>

    <hr>

    <h4>แบรนชั้นนำทั่วโลก</h4>
    <div class="row">
        <div class="col-3 text-center">
            <img src="https://www.siamphone.com/spec/acer/images/logo/thumb_logo_acer.png" alt="">
        </div>
        <div class="col-3 text-center">
            <img src="https://www.siamphone.com/spec/samsung/images/logo/thumb_logo_samsung.png" alt="">
        </div>
        <div class="col-3 text-center">
            <img src="https://www.siamphone.com/spec/apple/images/logo/thumb_logo_apple.png" alt="">
        </div>
        <div class="col-3 text-center">
            <img src="https://www.siamphone.com/spec/nokia/images/logo/thumb_logo_nokia.png" alt="">
        </div>
    </div>

    @include('customer.layouts.feature')
    @include('customer.layouts.owner')
    @include('customer.layouts.dsd')
</div>
@endsection
