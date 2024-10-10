@extends('core::layouts.master')

@section('title', 'Settings')

@section('content')
    @include('core::pages.settings._nav')

<form action="" class="pb-10">
    <!-- General Settings -->
    <x-core::card>
        <x-slot name="header">
            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M20.8239 6.28479L21.4737 5.91035L21.4737 5.91035L20.8239 6.28479ZM21.3175 7.14139L20.6676 7.51584L20.6676 7.51584L21.3175 7.14139ZM21.3175 16.8741L20.6676 16.4997L21.3175 16.8741ZM20.8239 17.7307L21.4737 18.1052L21.4737 18.1052L20.8239 17.7307ZM20.0407 13.3827L19.4522 13.8476L19.4664 13.8656L19.4817 13.8827L20.0407 13.3827ZM17.3311 18.3113L17.5345 17.5894L17.5172 17.5845L17.4997 17.5805L17.3311 18.3113ZM15.9724 18.4808L15.6296 17.8137L15.6133 17.8221L15.5975 17.8312L15.9724 18.4808ZM19.9464 18.8316L19.6638 18.1369L19.6638 18.1369L19.9464 18.8316ZM18.5513 18.655L18.756 17.9335L18.7546 17.9331L18.5513 18.655ZM21.0718 14.5354L20.5128 15.0354L20.5141 15.0369L21.0718 14.5354ZM17.3311 5.70418L17.4996 6.435L17.5171 6.43096L17.5344 6.42609L17.3311 5.70418ZM15.9726 5.53479L15.5977 6.18442L15.6136 6.19355L15.6298 6.20189L15.9726 5.53479ZM20.0407 10.6328L19.4817 10.1328L19.4664 10.1499L19.4522 10.1679L20.0407 10.6328ZM21.8084 8.37549L22.5543 8.45385L22.5543 8.45384L21.8084 8.37549ZM21.0718 9.48012L20.5141 8.97864L20.5128 8.98011L21.0718 9.48012ZM18.5513 5.36048L18.7546 6.08239L18.7561 6.08199L18.5513 5.36048ZM14.8475 4.37274L14.1363 4.61087L14.1415 4.62622L14.1473 4.64133L14.8475 4.37274ZM15.6357 5.34042L15.2312 5.97199L15.2458 5.98136L15.2609 5.99004L15.6357 5.34042ZM14.5136 3.37536L13.8019 3.61211L13.8024 3.61349L14.5136 3.37536ZM14.8476 19.6428L14.1473 19.3742L14.1415 19.3893L14.1364 19.4047L14.8476 19.6428ZM15.6356 18.6752L15.2607 18.0256L15.2456 18.0343L15.231 18.0437L15.6356 18.6752ZM13.9228 21.8191L14.3619 22.4271L14.3619 22.4271L13.9228 21.8191ZM14.5136 20.6403L13.8024 20.4021L13.8019 20.4035L14.5136 20.6403ZM3.30115 6.28479L2.65132 5.91035L2.65132 5.91035L3.30115 6.28479ZM2.80757 7.14139L3.4574 7.51584L3.4574 7.51584L2.80757 7.14139ZM2.80757 16.8741L3.4574 16.4997L2.80757 16.8741ZM3.30114 17.7307L2.6513 18.1052L2.6513 18.1052L3.30114 17.7307ZM4.08433 13.3827L4.64334 13.8827L4.65864 13.8656L4.67287 13.8476L4.08433 13.3827ZM6.79394 18.3113L6.6254 17.5805L6.60789 17.5845L6.59059 17.5894L6.79394 18.3113ZM8.15267 18.4808L8.52756 17.8312L8.51174 17.8221L8.49549 17.8137L8.15267 18.4808ZM4.17867 18.8316L4.46123 18.1369L4.46122 18.1369L4.17867 18.8316ZM5.57377 18.655L5.37042 17.9331L5.36901 17.9335L5.57377 18.655ZM3.05326 14.5354L3.61096 15.0369L3.61227 15.0354L3.05326 14.5354ZM6.79398 5.70418L6.59065 6.42609L6.60794 6.43096L6.62545 6.435L6.79398 5.70418ZM8.15249 5.53479L8.49524 6.20189L8.51149 6.19355L8.52731 6.18442L8.15249 5.53479ZM4.0843 10.6328L4.67284 10.1679L4.65861 10.1499L4.64331 10.1328L4.0843 10.6328ZM2.31666 8.37549L1.57076 8.45384L1.57076 8.45385L2.31666 8.37549ZM3.05326 9.48012L3.61227 8.98011L3.61095 8.97864L3.05326 9.48012ZM5.57375 5.36048L5.369 6.082L5.37041 6.08239L5.57375 5.36048ZM9.27753 4.37274L9.97779 4.64133L9.98358 4.62622L9.98872 4.61087L9.27753 4.37274ZM8.48937 5.34042L8.86419 5.99004L8.87924 5.98136L8.89387 5.97199L8.48937 5.34042ZM9.61149 3.37536L10.3227 3.61349L10.3231 3.61211L9.61149 3.37536ZM9.2775 19.6428L9.98869 19.4047L9.98355 19.3893L9.97776 19.3742L9.2775 19.6428ZM8.4895 18.6752L8.89406 18.0437L8.87944 18.0343L8.86439 18.0256L8.4895 18.6752ZM10.2022 21.8191L9.76313 22.4271L9.76313 22.4271L10.2022 21.8191ZM9.61149 20.6403L10.3231 20.4035L10.3227 20.4021L9.61149 20.6403ZM20.1741 6.65924L20.6676 7.51584L21.9673 6.76695L21.4737 5.91035L20.1741 6.65924ZM20.6676 16.4997L20.1741 17.3563L21.4737 18.1052L21.9673 17.2486L20.6676 16.4997ZM20.6293 12.9178C20.4997 12.7538 20.3598 12.3704 20.3598 12.0077H18.8598C18.8598 12.6452 19.0777 13.3735 19.4522 13.8476L20.6293 12.9178ZM17.4997 17.5805C16.8683 17.4349 16.2059 17.5175 15.6296 17.8137L16.3152 19.1479C16.5765 19.0136 16.8766 18.9762 17.1626 19.0421L17.4997 17.5805ZM20.1741 17.3563C19.9783 17.696 19.8634 17.8929 19.7634 18.0269C19.7181 18.0875 19.6896 18.1158 19.6751 18.1284C19.6684 18.1341 19.665 18.1363 19.6644 18.1366C19.6641 18.1368 19.6642 18.1368 19.6638 18.1369L20.2289 19.5264C20.5611 19.3913 20.7872 19.1628 20.9652 18.9245C21.1311 18.7023 21.2962 18.4133 21.4737 18.1052L20.1741 17.3563ZM18.3465 19.3765C18.6881 19.4735 19.0077 19.5655 19.2815 19.6089C19.5753 19.6556 19.8966 19.6615 20.2289 19.5264L19.6638 18.1369C19.6634 18.1371 19.6636 18.137 19.6632 18.1371C19.6627 18.1372 19.6588 18.1381 19.6501 18.1386C19.6311 18.1397 19.5913 18.1393 19.5167 18.1275C19.352 18.1013 19.1328 18.0404 18.756 17.9335L18.3465 19.3765ZM21.9673 17.2486C22.1336 16.96 22.2909 16.6893 22.3951 16.4486C22.5071 16.1901 22.5896 15.8983 22.5543 15.5617L21.0625 15.7184C21.0626 15.719 21.0626 15.7191 21.0625 15.7199C21.0625 15.7208 21.0622 15.7249 21.0605 15.7333C21.0568 15.7513 21.0467 15.7877 21.0186 15.8526C20.9564 15.9963 20.8513 16.181 20.6676 16.4997L21.9673 17.2486ZM20.5141 15.0369C20.7599 15.3103 20.9011 15.469 20.9918 15.5965C21.0327 15.6541 21.0501 15.6876 21.0575 15.7044C21.0609 15.7122 21.062 15.7161 21.0622 15.717C21.0624 15.7177 21.0624 15.7179 21.0625 15.7184L22.5543 15.5617C22.5189 15.2251 22.3775 14.9568 22.2142 14.7272C22.0622 14.5135 21.8521 14.2815 21.6295 14.0339L20.5141 15.0369ZM17.1625 4.97336C16.8766 5.0393 16.5766 5.00192 16.3153 4.86769L15.6298 6.20189C16.2061 6.49797 16.8683 6.58057 17.4996 6.435L17.1625 4.97336ZM19.4522 10.1679C19.0778 10.6419 18.8598 11.3703 18.8598 12.0077H20.3598C20.3598 11.6453 20.4997 11.2618 20.6293 11.0977L19.4522 10.1679ZM20.6676 7.51584C20.8513 7.8345 20.9564 8.01927 21.0186 8.16298C21.0467 8.22784 21.0568 8.26424 21.0605 8.28228C21.0622 8.29063 21.0625 8.29473 21.0625 8.29565C21.0626 8.29642 21.0626 8.29657 21.0625 8.29713L22.5543 8.45384C22.5896 8.11727 22.5071 7.82543 22.3951 7.56693C22.2909 7.3262 22.1336 7.05554 21.9673 6.76695L20.6676 7.51584ZM21.6295 9.9816C21.8521 9.73404 22.0622 9.50208 22.2142 9.28832C22.3775 9.05875 22.5189 8.79045 22.5543 8.45385L21.0625 8.29713C21.0624 8.29768 21.0624 8.29783 21.0622 8.29855C21.062 8.29943 21.0609 8.30336 21.0575 8.31115C21.0501 8.32798 21.0327 8.36144 20.9918 8.41899C20.9011 8.54651 20.7599 8.70526 20.5141 8.97864L21.6295 9.9816ZM21.4737 5.91035C21.2962 5.60222 21.1311 5.31326 20.9651 5.09104C20.7872 4.85276 20.5611 4.62426 20.2289 4.48915L19.6638 5.87862C19.6642 5.87878 19.6641 5.87871 19.6644 5.87894C19.665 5.87926 19.6684 5.88141 19.6751 5.88718C19.6896 5.89973 19.7181 5.928 19.7633 5.98863C19.8634 6.12262 19.9783 6.31954 20.1741 6.65924L21.4737 5.91035ZM18.7561 6.08199C19.1328 5.97509 19.352 5.91419 19.5167 5.88803C19.5912 5.8762 19.6311 5.8758 19.6501 5.87695C19.6588 5.87748 19.6627 5.87831 19.6632 5.87843C19.6636 5.87851 19.6634 5.87846 19.6638 5.87862L20.2289 4.48915C19.8966 4.35399 19.5753 4.35994 19.2815 4.40658C19.0077 4.45005 18.6882 4.54203 18.3466 4.63897L18.7561 6.08199ZM14.1473 4.64133C14.3574 5.1892 14.7371 5.65557 15.2312 5.97199L16.0402 4.70885C15.8161 4.5653 15.6434 4.35347 15.5478 4.10415L14.1473 4.64133ZM12.6199 2.75781C12.9844 2.75781 13.1947 2.75895 13.3485 2.77655C13.4179 2.78448 13.4538 2.79378 13.4708 2.79942C13.4787 2.80202 13.4822 2.80375 13.4829 2.80409C13.4834 2.80436 13.4834 2.80436 13.4837 2.80459L14.3619 1.58855C14.0892 1.39159 13.7969 1.31806 13.519 1.28627C13.2603 1.25667 12.9498 1.25781 12.6199 1.25781V2.75781ZM15.2252 3.1386C15.1209 2.82497 15.0238 2.5297 14.9141 2.2934C14.7963 2.0397 14.6345 1.78542 14.3619 1.58855L13.4837 2.80459C13.484 2.80483 13.4841 2.80484 13.4845 2.80531C13.4851 2.80589 13.4879 2.80874 13.493 2.81549C13.5038 2.83006 13.5241 2.8615 13.5536 2.92508C13.619 3.06598 13.6867 3.26573 13.8019 3.61211L15.2252 3.1386ZM15.5478 19.9114C15.6434 19.6621 15.816 19.4503 16.0401 19.3067L15.231 18.0437C14.737 18.3601 14.3574 18.8264 14.1473 19.3742L15.5478 19.9114ZM12.6199 22.7578C12.9498 22.7578 13.2603 22.759 13.519 22.7294C13.7969 22.6976 14.0892 22.624 14.3619 22.4271L13.4837 21.211C13.4834 21.2113 13.4834 21.2113 13.4829 21.2115C13.4822 21.2119 13.4787 21.2136 13.4708 21.2162C13.4538 21.2218 13.4179 21.2311 13.3485 21.2391C13.1947 21.2567 12.9844 21.2578 12.6199 21.2578V22.7578ZM13.8019 20.4035C13.6867 20.7499 13.619 20.9496 13.5536 21.0905C13.5241 21.1541 13.5038 21.1856 13.493 21.2001C13.4879 21.2069 13.4851 21.2097 13.4845 21.2103C13.4841 21.2108 13.484 21.2108 13.4837 21.211L14.3619 22.4271C14.6345 22.2302 14.7963 21.9759 14.9141 21.7222C15.0238 21.4859 15.1209 21.1907 15.2252 20.877L13.8019 20.4035ZM13.8024 3.61349L14.1363 4.61087L15.5587 4.13461L15.2248 3.13723L13.8024 3.61349ZM16.3474 4.88517L16.0105 4.6908L15.2609 5.99004L15.5977 6.18442L16.3474 4.88517ZM17.5344 6.42609L18.7546 6.08239L18.348 4.63857L17.1277 4.98227L17.5344 6.42609ZM20.5128 8.98011L19.4817 10.1328L20.5998 11.1328L21.6308 9.98013L20.5128 8.98011ZM19.4817 13.8827L20.5128 15.0354L21.6308 14.0354L20.5997 12.8827L19.4817 13.8827ZM17.1278 19.0332L18.3479 19.3769L18.7546 17.9331L17.5345 17.5894L17.1278 19.0332ZM16.0104 19.3248L16.3473 19.1304L15.5975 17.8312L15.2607 18.0256L16.0104 19.3248ZM14.1364 19.4047L13.8024 20.4021L15.2248 20.8784L15.5587 19.8809L14.1364 19.4047ZM2.65132 5.91035L2.15773 6.76695L3.4574 7.51584L3.95099 6.65924L2.65132 5.91035ZM2.15773 17.2486L2.6513 18.1052L3.95098 17.3563L3.4574 16.4997L2.15773 17.2486ZM4.67287 13.8476C5.04735 13.3735 5.26521 12.6452 5.26521 12.0077H3.76521C3.76521 12.3704 3.62537 12.7538 3.49578 12.9178L4.67287 13.8476ZM6.96248 19.0421C7.24847 18.9762 7.54856 19.0136 7.80984 19.1479L8.49549 17.8137C7.91917 17.5175 7.25678 17.4349 6.6254 17.5805L6.96248 19.0421ZM2.6513 18.1052C2.82885 18.4133 2.99392 18.7023 3.15989 18.9245C3.33786 19.1628 3.56391 19.3913 3.89612 19.5264L4.46122 18.1369C4.46084 18.1368 4.46097 18.1368 4.4606 18.1366C4.46009 18.1363 4.45667 18.1341 4.44998 18.1284C4.43543 18.1158 4.40699 18.0875 4.3617 18.0269C4.26162 17.8929 4.14672 17.696 3.95098 17.3563L2.6513 18.1052ZM5.36901 17.9335C4.99227 18.0404 4.77308 18.1013 4.60831 18.1275C4.5338 18.1393 4.49392 18.1397 4.47494 18.1386C4.46623 18.1381 4.46235 18.1372 4.46182 18.1371C4.46145 18.137 4.46161 18.1371 4.46123 18.1369L3.89611 19.5264C4.22843 19.6615 4.54979 19.6556 4.84355 19.6089C5.11735 19.5655 5.43692 19.4735 5.77853 19.3765L5.36901 17.9335ZM3.4574 16.4997C3.27379 16.181 3.16864 15.9963 3.10641 15.8526C3.07832 15.7877 3.06826 15.7513 3.06456 15.7333C3.06285 15.7249 3.06258 15.7208 3.06253 15.7199C3.06248 15.7191 3.0625 15.719 3.06255 15.7184L1.57076 15.5617C1.5354 15.8983 1.61798 16.1901 1.72992 16.4486C1.83416 16.6893 1.99144 16.96 2.15773 17.2486L3.4574 16.4997ZM2.49557 14.0339C2.27297 14.2815 2.06285 14.5135 1.91083 14.7272C1.74757 14.9568 1.60613 15.2251 1.57076 15.5617L3.06255 15.7184C3.06261 15.7179 3.06263 15.7177 3.06283 15.717C3.06306 15.7161 3.06418 15.7122 3.06758 15.7044C3.07492 15.6876 3.09231 15.6541 3.13323 15.5965C3.22392 15.469 3.36513 15.3103 3.61096 15.0369L2.49557 14.0339ZM6.62545 6.435C7.25672 6.58057 7.91899 6.49797 8.49524 6.20189L7.80974 4.86769C7.54849 5.00192 7.24846 5.0393 6.96252 4.97336L6.62545 6.435ZM3.49576 11.0977C3.62534 11.2618 3.76521 11.6453 3.76521 12.0077H5.26521C5.26521 11.3703 5.04726 10.6419 4.67284 10.1679L3.49576 11.0977ZM2.15773 6.76695C1.99144 7.05554 1.83416 7.3262 1.72992 7.56693C1.61798 7.82543 1.5354 8.11727 1.57076 8.45384L3.06255 8.29713C3.06249 8.29657 3.06248 8.29642 3.06252 8.29565C3.06258 8.29473 3.06285 8.29063 3.06456 8.28228C3.06826 8.26424 3.07832 8.22784 3.10641 8.16298C3.16863 8.01927 3.27379 7.8345 3.4574 7.51584L2.15773 6.76695ZM3.61095 8.97864C3.36513 8.70526 3.22392 8.54651 3.13323 8.41899C3.0923 8.36144 3.07492 8.32798 3.06757 8.31115C3.06417 8.30336 3.06306 8.29943 3.06283 8.29855C3.06263 8.29783 3.06261 8.29768 3.06255 8.29713L1.57076 8.45385C1.60613 8.79045 1.74757 9.05875 1.91083 9.28832C2.06285 9.50208 2.27296 9.73404 2.49557 9.9816L3.61095 8.97864ZM3.95099 6.65924C4.14673 6.31954 4.26163 6.12262 4.36171 5.98863C4.407 5.928 4.43543 5.89973 4.44998 5.88718C4.45667 5.88141 4.46009 5.87926 4.4606 5.87894C4.46097 5.87871 4.46085 5.87878 4.46123 5.87862L3.89611 4.48915C3.56392 4.62426 3.33787 4.85276 3.15991 5.09104C2.99394 5.31326 2.82887 5.60222 2.65132 5.91035L3.95099 6.65924ZM5.77849 4.63897C5.43689 4.54203 5.11732 4.45005 4.84353 4.40658C4.54977 4.35994 4.22841 4.35399 3.89611 4.48915L4.46123 5.87862C4.46162 5.87846 4.46146 5.87851 4.46182 5.87843C4.46236 5.87831 4.46623 5.87748 4.47495 5.87695C4.49392 5.8758 4.5338 5.8762 4.60832 5.88803C4.77308 5.91419 4.99226 5.97509 5.369 6.08199L5.77849 4.63897ZM8.57727 4.10415C8.48165 4.35347 8.30899 4.5653 8.08487 4.70885L8.89387 5.97199C9.38791 5.65557 9.76765 5.1892 9.97779 4.64133L8.57727 4.10415ZM11.5051 1.25781C11.1753 1.25781 10.8648 1.25667 10.6061 1.28627C10.3281 1.31806 10.0359 1.39159 9.76313 1.58855L10.6413 2.80459C10.6416 2.80436 10.6416 2.80436 10.6422 2.80409C10.6428 2.80375 10.6463 2.80202 10.6542 2.79942C10.6712 2.79378 10.7072 2.78448 10.7766 2.77655C10.9304 2.75895 11.1407 2.75781 11.5051 2.75781V1.25781ZM10.3231 3.61211C10.4384 3.26573 10.506 3.06598 10.5714 2.92508C10.601 2.8615 10.6212 2.83006 10.6321 2.81549C10.6371 2.80874 10.6399 2.80589 10.6405 2.80531C10.641 2.80484 10.641 2.80483 10.6413 2.80459L9.76313 1.58855C9.49052 1.78542 9.32872 2.0397 9.21093 2.2934C9.10121 2.5297 9.00418 2.82497 8.89984 3.1386L10.3231 3.61211ZM9.97776 19.3742C9.76766 18.8264 9.388 18.3601 8.89406 18.0437L8.08493 19.3067C8.30901 19.4503 8.48163 19.6621 8.57724 19.9114L9.97776 19.3742ZM11.5051 21.2578C11.1407 21.2578 10.9304 21.2567 10.7766 21.2391C10.7072 21.2311 10.6712 21.2218 10.6542 21.2162C10.6463 21.2136 10.6428 21.2119 10.6422 21.2115C10.6416 21.2113 10.6416 21.2113 10.6413 21.211L9.76313 22.4271C10.0359 22.624 10.3281 22.6976 10.6061 22.7294C10.8648 22.759 11.1753 22.7578 11.5051 22.7578V21.2578ZM8.89984 20.877C9.00418 21.1907 9.10121 21.4859 9.21093 21.7222C9.32872 21.9759 9.49052 22.2302 9.76313 22.4271L10.6413 21.211C10.641 21.2108 10.641 21.2108 10.6405 21.2103C10.6399 21.2097 10.6371 21.2069 10.6321 21.2001C10.6212 21.1856 10.601 21.1541 10.5714 21.0905C10.506 20.9496 10.4384 20.7499 10.3231 20.4035L8.89984 20.877ZM8.90029 3.13723L8.56634 4.13461L9.98872 4.61087L10.3227 3.61349L8.90029 3.13723ZM8.52731 6.18442L8.86419 5.99004L8.11455 4.6908L7.77766 4.88517L8.52731 6.18442ZM6.99732 4.98227L5.77708 4.63857L5.37041 6.08239L6.59065 6.42609L6.99732 4.98227ZM2.49425 9.98013L3.52529 11.1328L4.64331 10.1328L3.61227 8.98011L2.49425 9.98013ZM3.52532 12.8827L2.49426 14.0354L3.61227 15.0354L4.64334 13.8827L3.52532 12.8827ZM6.59059 17.5894L5.37042 17.9331L5.77712 19.3769L6.99729 19.0332L6.59059 17.5894ZM8.86439 18.0256L8.52756 17.8312L7.77778 19.1304L8.11461 19.3248L8.86439 18.0256ZM8.56631 19.8809L8.90029 20.8784L10.3227 20.4021L9.98869 19.4047L8.56631 19.8809ZM12.6199 21.2578H11.5051V22.7578H12.6199V21.2578ZM11.5051 2.75781H12.6199V1.25781H11.5051V2.75781ZM14.7695 12C14.7695 13.5188 13.5383 14.75 12.0195 14.75V16.25C14.3667 16.25 16.2695 14.3472 16.2695 12H14.7695ZM12.0195 14.75C10.5007 14.75 9.26953 13.5188 9.26953 12H7.76953C7.76953 14.3472 9.67232 16.25 12.0195 16.25V14.75ZM9.26953 12C9.26953 10.4812 10.5007 9.25 12.0195 9.25V7.75C9.67232 7.75 7.76953 9.65279 7.76953 12H9.26953ZM12.0195 9.25C13.5383 9.25 14.7695 10.4812 14.7695 12H16.2695C16.2695 9.65279 14.3667 7.75 12.0195 7.75V9.25Z" fill="#2A353D" />
            </svg>
            General Settings
        </x-slot>
    
        <div class="row row-cols-lg-3 row-cols-1 row-cols-sm-2 g-3">
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="app_name" :value="'App Name'" />
                    <x-core::form.input type="text" id="app_name" name="app_name" value="{{ old('app_name') }}" />
                    <x-core::form.input-error field="app_name" />
                </div>                  
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="app_mode" :value="'App Mode'" />
                    <select class="form-select conca-select2" id="app_mode" name="app_mode">
                        <option value="development">Development</option>
                        <option value="production">Production</option>
                    </select>
                    <x-core::form.input-error field="app_mode" />
                </div>                  
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_email" :value="'Site Email'" />
                    <x-core::form.input type="text" id="site_email" name="site_email" value="{{ old('site_email') }}" />
                    <x-core::form.input-error field="site_email" />
                </div>                  
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_address" :value="'Site Address'" />
                    <x-core::form.input type="text" id="site_address" name="site_address" value="{{ old('site_address') }}" />
                    <x-core::form.input-error field="site_address" />
                </div>                  
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_latitude" :value="'Latitude'" />
                    <x-core::form.input type="text" id="site_latitude" name="site_latitude" value="{{ old('site_latitude') }}" />
                    <x-core::form.input-error field="site_latitude" />
                </div>                  
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_longitude" :value="'Longitude'" />
                    <x-core::form.input type="text" id="site_longitude" name="site_longitude" value="{{ old('site_longitude') }}" />
                    <x-core::form.input-error field="site_longitude" />
                </div>                  
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_timezone" :value="'Timezone'" />
                    <select name="site_timezone" class="form-select conca-select2">
                        @foreach (timezone_identifiers_list() as $timezone)
                            <option value="{{ $timezone }}" {{ config('app.timezone') == $timezone ? 'selected' : '' }}>
                                {{ $timezone }}
                            </option>
                        @endforeach
                    </select>
                    <x-core::form.input-error field="site_timezone" />
                </div>                  
            </div>

            @php
                $today = \Carbon\Carbon::now();
                $formats = [
                    'Y-m-d' => 'YYYY-MM-DD (' . $today->format('Y-m-d') . ')',
                    'd/m/Y' => 'DD/MM/YYYY (' . $today->format('d/m/Y') . ')',
                    'm-d-Y' => 'MM-DD-YYYY (' . $today->format('m-d-Y') . ')',
                    'M d, Y' => 'Month Day, Year (' . $today->format('M d, Y') . ')',
                    'D, M d Y' => 'Day, Month Day Year (' . $today->format('D, M d Y') . ')',
                    'F j, Y' => 'Full Month Name, Day, Year (' . $today->format('F j, Y') . ')',
                    'Y/m/d' => 'YYYY/MM/DD (' . $today->format('Y/m/d') . ')',
                    'd M, Y' => 'Day Month, Year (' . $today->format('d M, Y') . ')',
                    'l, F j, Y' => 'Weekday, Full Month Day, Year (' . $today->format('l, F j, Y') . ')',
                    'jS F Y' => 'Day Ordinal Full Month Year (' . $today->format('jS F Y') . ')',
                    'd.m.Y' => 'DD.MM.YYYY (' . $today->format('d.m.Y') . ')',
                    'Ymd' => 'YYYYMMDD (' . $today->format('Ymd') . ')',
                ];                
            @endphp

            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_date_format" :value="'Date Format'" />
                    <select name="site_date_format" id="site_date_format" class="form-select conca-select2">
                        @foreach ($formats as $format => $label)
                            <option value="{{ $format }}" {{ config('app.date_format') == $format ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                    <x-core::form.input-error field="site_date_format" />
                </div>                  
            </div>
        </div> 
    </x-core::card>    


    <!-- Business information -->
    <x-core::card>
        <x-slot name="header">
            Business information
        </x-slot>

        <div class="row row row-cols-lg-3 row-cols-1 row-cols-sm-2 g-3">
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_currency" :value="'Currency'" />
                    <select name="site_currency" class="form-select conca-select2">
                        <option value="USD">USD</option>
                        <option value="EUR">EUR</option>
                        <option value="GBP">GBP</option>
                        <option value="INR">INR</option>
                        <option value="AUD">AUD</option>
                        <option value="CAD">CAD</option>
                    </select>
                    <x-core::form.input-error field="site_currency" />
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_currency" :value="'Currency Position'" />
                    <div class="form-control form-group d-flex gap-4">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="site_currency_position" id="currency_left" value="left" checked>
                            <label class="form-check-label" for="currency_left">($) Left Side</label>
                        </div>                          
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="site_currency_position" id="currency_right" value="right">
                            <label class="form-check-label" for="currency_right">Right Side ($)</label>
                        </div>                          
                    </div>
                    <x-core::form.input-error field="site_currency" />
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_digit_after_decimal" :value="'Digits After Decimal ( Ex:0.00) '" />
                    <x-core::form.input type="number" id="site_digit_after_decimal" name="site_digit_after_decimal" value="{{ old('site_digit_after_decimal', 2) }}" />
                    <x-core::form.input-error field="site_digit_after_decimal" />
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_basic_pagination" :value="'Pagination'" />
                    <x-core::form.input type="number" id="site_basic_pagination" name="site_basic_pagination" value="{{ old('site_basic_pagination', 10) }}" />
                    <x-core::form.input-error field="site_basic_pagination" />
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <x-core::form.input-label for="site_copyright" :value="'Copyright'" />
                    <x-core::form.input type="text" id="site_copyright" name="site_copyright" value="{{ old('site_copyright') }}" />
                    <x-core::form.input-error field="site_copyright" />
                </div>
            </div>
        </div>

    </x-core::card>
    
    <div class="row row-cols-lg-3 row-cols-1 row-cols-sm-2">
        <!-- site color -->
        <div class="col">
            <x-core::card>
                <x-slot name="header">
                    Website Color
                </x-slot>
    
                <div class="mb-4">
                    <x-core::form.input-label for="site_color_primary" :value="'Primary'" />
                    <div class="input-group">
                        <x-core::form.input type="text" id="site_color_primary" name="site_color_primary" class="input-color" value="{{ old('site_color_primary') }}" />
                        <span class="input-group-text site-color-primary input-color-placeholder"></span>
                    </div>   
                    <div class="form-text">Add HEX color code (#fff)</div>
                    <x-core::form.input-error field="site_color_primary" />                   
                </div>                  
                <div class="mb-3">
                    <x-core::form.input-label for="site_color_secondary" :value="'Secondary'" />
                    <div class="input-group">
                        <x-core::form.input type="text" id="site_color_secondary" name="site_color_secondary" class="input-color" value="{{ old('site_color_secondary') }}" />
                        <span class="input-group-text site-color-secondary input-color-placeholder"></span>
                    </div>   
                    <div class="form-text">Add HEX color code (#fff)</div>
                    <x-core::form.input-error field="site_color_secondary" />                   
                </div> 
    
            </x-core::card>   
            
            <!-- preloader -->
            <x-core::card>
                <x-slot name="header">
                    Preloader
                </x-slot>
    
                <div class="mb-4">
                    <div class="form-check form-switch">
                        <input class="form-check-input" type="checkbox" role="switch" id="site_preloader_switch" checked>
                        <label class="form-check-label" for="site_preloader_switch">Enable Preloader ?</label>
                    </div>                      
                </div>

                <div class="mb-4">
                    <x-core::form.input-label for="site_preloader_ovarlay_color" :value="'Preloader Overlay Color'" />
                    <div class="input-group">
                        <x-core::form.input type="text" id="site_preloader_ovarlay_color" name="site_preloader_ovarlay_color" class="input-color" value="{{ old('site_preloader_ovarlay_color') }}" />
                        <span class="input-group-text site-color-primary input-color-placeholder"></span>
                    </div>   
                    <div class="form-text">Add HEX color code (#fff)</div>
                    <x-core::form.input-error field="site_preloader_ovarlay_color" />                   
                </div>
    
            </x-core::card>
        </div>
    
        <!-- site logo -->
        <div class="col">
            <x-core::card>
                <x-slot name="header">
                    Website Logo
                </x-slot>
    
                @php
                    $site_logo_primary = asset('demo/logo/logo.png');
                    $site_logo_secondary = asset('demo/logo/logo-2.png');
                    $site_favicon = asset('demo/logo/favicon.png');
                @endphp
    
                <div class="mb-5">
                    <x-core::form.input-label class="d-block" :value="'Primary Logo'" />
                    
                    <div class="mb-2 image-upload-container">
                        <img src="{{$site_logo_primary}}" class="img-thumbnail site-logo-primary image-preview" alt="site-logo-primary" data-default="{{$site_logo_primary}}">
                    </div>
                    
                    <label for="site_logo_primary" class="btn btn-label-primary me-3">
                        <span>Upload Primary</span>                    
                        <x-core::form.input type="file" id="site_logo_primary" name="site_logo_primary" class="image-input" data-target=".site-logo-primary" data-reset=".site-logo-primary-reset" hidden />
                    </label>
                    <button type="button" class="btn btn-label-secondary site-logo-primary-reset image-reset d-none" data-target=".site-logo-primary">Reset</button>
                    
                    <x-core::form.input-error field="site_logo_primary" />
                </div>

                
                <div class="mb-3">
                    <x-core::form.input-label class="d-block" :value="'Secondary Logo'" />
                    
                    <div class="mb-2 image-upload-container">
                        <img src="{{$site_logo_secondary}}" class="img-thumbnail site-logo-secondary image-preview" alt="site-logo-secondary" data-default="{{$site_logo_secondary}}">
                    </div>
                    
                    <label for="site_logo_secondary" class="btn btn-label-primary me-3">
                        <span>Upload Secondary</span>                    
                        <x-core::form.input type="file" id="site_logo_secondary" name="site_logo_secondary" class="image-input" data-target=".site-logo-secondary" data-reset=".site-logo-secondary-reset" hidden />
                    </label>
                    <button type="button" class="btn btn-label-secondary site-logo-secondary-reset image-reset d-none" data-target=".site-logo-secondary">Reset</button>

    
                    <x-core::form.input-error field="site_logo_secondary" />
                </div>
    
            </x-core::card>
        </div>
    
        <!-- site favicon -->
        <div class="col">
            <!-- site favicon -->
            <x-core::card>
                <x-slot name="header">
                    Website Favicon
                </x-slot>
    
                <div class="mb-3">
                    <x-core::form.input-label class="d-block" :value="'Favicon'" />

                    <div class="mb-2 image-upload-container">
                        <img src="{{$site_favicon}}" class="img-thumbnail site-favicon image-preview" alt="site-favicon" data-default="{{$site_favicon}}">
                    </div>

                    <label for="site_favicon" class="btn btn-label-primary me-3">
                        <span>Upload Favicon</span>                    
                        <x-core::form.input type="file" id="site_favicon" name="site_favicon" class="image-input" data-target=".site-favicon" data-reset=".site-favicon-reset" hidden />
                    </label>
                    <button type="button" class="btn btn-label-secondary site-favicon-reset image-reset d-none" data-target=".site-favicon">Reset</button>
    
                    <x-core::form.input-error field="site_favicon" />
                </div>
    
            </x-core::card>

        </div>
    </div>

    <x-core::card>
        <x-slot name="header">
            Maintanance Mode
        </x-slot>

        <div class="alert alert-warning d-flex align-items-start gap-2 mb-5" role="alert">
            <span class="flex-shrink-1">
                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M8.50001 11.9615C8.81864 11.9615 9.07693 11.7032 9.07693 11.3846C9.07693 11.0659 8.81864 10.8077 8.50001 10.8077C8.18138 10.8077 7.92309 11.0659 7.92309 11.3846C7.92309 11.7032 8.18138 11.9615 8.50001 11.9615Z" fill="currentColor" />
                    <path d="M8.5 4.46148V7.92302M16 8.5C16 12.6421 12.6421 16 8.5 16C4.35786 16 1 12.6421 1 8.5C1 4.35786 4.35786 1 8.5 1C12.6421 1 16 4.35786 16 8.5ZM9.07693 11.3846C9.07693 11.7032 8.81864 11.9615 8.50001 11.9615C8.18138 11.9615 7.92309 11.7032 7.92309 11.3846C7.92309 11.0659 8.18138 10.8077 8.50001 10.8077C8.81864 10.8077 9.07693 11.0659 9.07693 11.3846Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                  </svg>
            </span>
            <div>
                If you enable maintenance mode, regular users wont be able to access the website. Please make sure to inform users about the temporary unavailability. 
            </div>
        </div> 

        <div class="d-flex justify-content-between align-items-center border rounded mb-4 p-3">                    
            <div class="form-check form-switch d-flex align-items-center gap-2">
                <input class="form-check-input" type="checkbox" role="switch" id="site_maintenance_mode_switch">
                <label class="form-check-label" for="site_maintenance_mode_switch">Active Maintenance Mode ?</label>
            </div>                      
        </div>

        <x-core::form.input-label for="site_maintenance_page" :value="'Page Template'" />
        <select name="site_maintenance_page" class="form-select conca-select2">
            <option value="1">Maintenance Page 1</option>
            <option value="2">Maintenance Page 2</option>
            <option value="3">Maintenance Page 3</option>
        </select>
        <x-core::form.input-error field="site_maintenance_page" />

    </x-core::card>

    <div class="row">
        <div class="col-xl-12">
            <button type="submit" class="btn btn-primary float-end">Save Information</button>
        </div>
    </div>

</form>

@endsection


@push('scripts')
<script>
    "use strict";

    $(document).ready(function(){

        // Handle number input & check it is positive
        $('input[type="number"]').on('input', function(){
            if($(this).val() < 1){
                $(this).val(1);
            }
        });

    });
</script>
    
@endpush