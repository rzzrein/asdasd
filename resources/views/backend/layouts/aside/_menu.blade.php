<div
    class="hover-scroll-overlay-y my-5 my-lg-5"
    id="kt_aside_menu_wrapper"
    data-kt-scroll="true"
    data-kt-scroll-activate="{default: false, lg: true}"
    data-kt-scroll-height="auto"
    data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
    data-kt-scroll-wrappers="#kt_aside_menu"
    data-kt-scroll-offset="0"
>
    {{--begin::Menu--}}
    <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
        <!-- <div class="menu-item">
            <a class="menu-link" href="{{ route('admin.dashboard') }}">
                <span class="menu-icon">
                    <span class="svg-icon svg-icon-2">
                        <i class="nav-icon fas fa-home"></i>
                    </span>
                </span>
                <span class="menu-title">Dashboard</span>
            </a>
        </div> -->
        <div class="menu-item">
            <div class="menu-content pt-8 pb-2">
                <span class="menu-section text-muted text-uppercase fs-8 ls-1">Modules</span>
            </div>
        </div>

        <!-- @if (checkPerm('admin-user-index') || checkPerm('admin-role-index') || checkPerm('admin-permission-index'))

        @php
            $userClass = request()->routeIs('admin.users.*') || request()->routeIs('admin.permissions.*') || request()->routeIs('admin.roles.*') || request()->routeIs('admin.permission-roles.*') ? true : false ;
        @endphp

        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ $userClass ? 'hover show' : '' }}">
            <span class="menu-link">
                <span class="menu-icon">
                    <span class="svg-icon svg-icon-2">
                        <i class="fa-solid fa-user-shield"></i>
                    </span>
                </span>
                <span class="menu-title">Account Management</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $userClass ? 'show' : '' --}}">
                <div class="menu-item">
                    <a class="menu-link {{-- request()->routeIs('admin.users.*') ? 'active' : ''--}}" href="{{-- route('admin.users.index') --}}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">User Management</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{-- request()->routeIs('admin.roles.*') ? 'active' : ''--}}" href="{{-- route('admin.roles.index') --}}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Role Management</span>
                    </a>
                </div>
                <div class="menu-item">
                    <a class="menu-link {{-- request()->routeIs('admin.permissions.*') ? 'active' : ''--}}" href="{{-- route('admin.permissions.index') --}}">
                        <span class="menu-bullet">
                            <span class="bullet bullet-dot"></span>
                        </span>
                        <span class="menu-title">Permission Management</span>
                    </a>
                </div>
            </div>
        </div>

        @endif -->

        <!-- Account Management -->

        @if (checkPerm('admin-user-index') || checkPerm('admin-role-index') || checkPerm('admin-permission-index'))
            @php
                $userClass = request()->routeIs('admin.users.*') || request()->routeIs('admin.permissions.*') || request()->routeIs('admin.roles.*') || request()->routeIs('admin.permission-roles.*') ? true : false ;
            @endphp
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ $userClass ? 'hover show' : '' }}">
                <div class="menu-item">
                    <a class="menu-link {{ request()->routeIs('admin.users.*') ? 'active' : ''}}" href="{{ route('admin.users.index') }}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <i class="fa-solid fa-user-shield"></i>
                            </span>
                        </span>
                        <span class="menu-title">User Management</span>
                    </a>
                </div>
            </div>
        @endif

        <!-- Medical Record -->
        @php
            $medicalRecordClass = request()->routeIs('admin.medical-records.*');
        @endphp
        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ $medicalRecordClass ? 'hover show' : '' }}">
            <div class="menu-item">
                <a class="menu-link {{ request()->routeIs('admin.medical-records.*') ? 'active' : ''}}" href="{{ route('admin.medical-records.index') }}">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fa-solid fa-bars-progress"></i>
                        </span>
                    </span>
                    <span class="menu-title">Medical Records</span>
                </a>
            </div>
        </div>

        {{-- User Account --}}
        <!-- @if (checkPerm('admin-customer-index') || checkPerm('admin-seller-index'))
            @php
                $userAccountClass = request()->routeIs('admin.user-customer.*')   ? true : false ;
            @endphp
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $userAccountClass ? 'hover show' : '' --}}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fa-solid fa-users"></i>
                        </span>
                    </span>
                    <span class="menu-title">User Account</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $userAccountClass ? 'show' : '' --}}">
                    @if (checkPerm('admin-customer-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.user-customer.*') ? 'active' : ''--}}" href="{{-- route('admin.user-customer.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Customer & Seller</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif -->

        {{-- Content Management --}}
        <!-- @if (checkPerm('admin-article-index') || checkPerm('admin-testimony-index'))
            @php
                $contentManagement = request()->routeIs('admin.articles.*') || request()->routeIs('admin.site-testimonies.*') || request()->routeIs('admin.tags.*') || request()->routeIs('admin.medical-records.*')  ? true : false ;
            @endphp
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $contentManagement ? 'hover show' : '' --}}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fa-solid fa-shapes"></i>
                        </span>
                    </span>
                    <span class="menu-title">Content Management</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $contentManagement ? 'show' : '' --}}">
                    @if (checkPerm('admin-tag-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.tags.*') ? 'active' : ''--}}" href="{{-- route('admin.tags.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Tags</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-article-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.articles.*') ? 'active' : ''--}}" href="{{-- route('admin.articles.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Article</span>
                            </a>
                        </div>
                    @endif
                    <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.medical-records.*') ? 'active' : ''--}}" href="{{-- route('admin.medical-records.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Rekam Medis</span>
                            </a>
                        </div>
                    @if (checkPerm('admin-site-testimony-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.site-testimonies.*') ? 'active' : ''--}}" href="{{-- route('admin.site-testimonies.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Testimoni</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif -->

        {{-- Payment Management --}}
        <!-- @if (checkPerm('admin-car-payment-index') || checkPerm('admin-payment-method-index') || checkPerm('admin-payment-duration-index') || checkPerm('admin-ewallet-index') || checkPerm('admin-withdraw-index') || checkPerm('admin-service-payment-index') || checkPerm('admin-refund-index') || checkPerm('admin-disbursement-index') || checkPerm('admin-service-refund-index') || checkPerm('admin-payment-amount-index'))
            @php
                $paymentClass = request()->routeIs('admin.car-payment.*') || request()->routeIs('admin.payment-method.*') || request()->routeIs('admin.payment-duration.*') || request()->routeIs('admin.ewallet.*') || request()->routeIs('admin.withdraw.*') || request()->routeIs('admin.service-payments.*') || request()->routeIs('admin.refund.*') || request()->routeIs('admin.disbursements.*') || request()->routeIs('admin.service-refunds.*') || request()->routeIs('admin.payment-amount.*') ? true : false ;
            @endphp
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $paymentClass ? 'hover show' : '' --}}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fa-solid fa-cash-register"></i>
                        </span>
                    </span>
                    <span class="menu-title">Payment Management</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $paymentClass ? 'show' : '' --}}">
                    @if (checkPerm('admin-service-payment-index') || checkPerm('admin-service-payment-index'))
                        @php
                            $listPaymentClass = request()->routeIs('admin.car-payment.list') || request()->routeIs('admin.service-payments.index');
                        @endphp
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $listPaymentClass ? 'hover show' : '' --}}">
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">List Payment</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $listPaymentClass ? 'show' : '' --}}">
                                @if (checkPerm('admin-car-payment-index'))
                                    <div class="menu-item">
                                        <a class="menu-link {{-- request()->routeIs('admin.car-payment.list') ? 'active' : ''--}}" href="{{-- route('admin.car-payment.list') --}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Dealer</span>
                                        </a>
                                    </div>
                                @endif
                                @if (checkPerm('admin-service-payment-index'))
                                    <div class="menu-item">
                                        <a class="menu-link {{-- request()->routeIs('admin.service-payments.index') ? 'active' : ''--}}" href="{{-- route('admin.service-payments.index') --}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Servis</span>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                    @if (checkPerm('admin-payment-method-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.payment-method.*') ? 'active' : ''--}}" href="{{-- route('admin.payment-method.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Payment Method</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-payment-duration-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.payment-duration.*') ? 'active' : ''--}}" href="{{-- route('admin.payment-duration.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Payment Duration Management</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-payment-amount-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.payment-amount.*') ? 'active' : ''--}}" href="{{-- route('admin.payment-amount.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Payment Amount Management</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-ewallet-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.ewallet.*') ? 'active' : ''--}}" href="{{-- route('admin.ewallet.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">E-Wallet</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-disbursement-index'))
                        @php
                            $disbursementClass = request()->routeIs('admin.disbursements.index');
                        @endphp
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $disbursementClass ? 'hover show' : '' --}}">
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Disbursement</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $disbursementClass ? 'show' : '' --}}">
                                @if (checkPerm('admin-disbursement-index'))
                                    <div class="menu-item">
                                        <a class="menu-link {{-- request()->routeIs('admin.disbursements.*') ? 'active' : ''--}}" href="{{-- route('admin.disbursements.index') --}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Servis</span>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                    @if (checkPerm('admin-refund-index') || checkPerm('admin-service-refund-index'))
                        @php
                            $refundClass = request()->routeIs('admin.refund.index') || request()->routeIs('admin.service-refunds.index');
                        @endphp
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $refundClass ? 'hover show' : '' --}}">
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Refund Payment Request</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $refundClass ? 'show' : '' --}}">
                                @if (checkPerm('admin-refund-index'))
                                    <div class="menu-item">
                                        <a class="menu-link {{-- request()->routeIs('admin.refund.*') ? 'active' : ''--}}" href="{{-- route('admin.refund.index') --}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Dealer</span>
                                        </a>
                                    </div>
                                @endif
                                @if (checkPerm('admin-service-refund-index'))
                                    <div class="menu-item">
                                        <a class="menu-link {{-- request()->routeIs('admin.service-refunds.*') ? 'active' : ''--}}" href="{{-- route('admin.service-refunds.index') --}}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">Servis</span>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    @endif
                    @if (checkPerm('admin-withdraw-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.withdraw.*') ? 'active' : ''--}}" href="{{-- route('admin.withdraw.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Withdraw</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif -->

        {{-- Leads Management --}}
        <!-- @if (checkPerm('admin-lead-tradein-index') || checkPerm('admin-lead-sell-index'))
            @php
                $leadsManagementClass = request()->routeIs('admin.car-lead.*') || request()->routeIs('admin.service.order.*') ? true : false ;
            @endphp
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $leadsManagementClass ? 'hover show' : '' --}}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fa-solid fa-list-check"></i>
                        </span>
                    </span>
                    <span class="menu-title">Leads Management</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $leadsManagementClass ? 'show' : '' --}}">
                    @if (checkPerm('admin-lead-submitlist-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.car-lead.submit-list') || request()->routeIs('admin.car-lead.submit-list.*') ? 'active' : ''--}}" href="{{-- route('admin.car-lead.submit-list') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">List Pengajuan</span>
                            </a>
                        </div>
                    @endif

                    @if (checkPerm('admin-lead-transaction-index'))
                        @php
                            $transactionClass = request()->routeIs('admin.car-lead.transaction-skd') || request()->routeIs('admin.car-lead.transaction-skd.*') || request()->routeIs('admin.service.order.*') ? true : false ;
                        @endphp
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $transactionClass ? 'hover show' : '' --}}">
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">List Transaction</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $transactionClass ? 'show' : '' --}}">

                                <div class="menu-item">
                                    <a class="menu-link {{-- request()->routeIs('admin.car-lead.transaction-skd') || request()->routeIs('admin.car-lead.transaction-skd.*') ? 'active' : ''--}}"
                                        href="{{-- route('admin.car-lead.transaction-skd') --}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Dealer</span>
                                    </a>
                                </div>
                                <div class="menu-item">
                                    <a class="menu-link {{-- request()->routeIs('admin.service.order.*') ? 'active' : ''--}}"
                                        href="{{-- route('admin.service.order.index') --}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">Service</span>
                                    </a>
                                </div>

                            </div>
                        </div>
                    @endif

                    @if (checkPerm('admin-lead-tradein-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.car-lead.index') ? 'active' : ''--}}" href="{{-- route('admin.car-lead.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">List Tukar Tambah</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-lead-sell-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.car-lead.sell-it') ? 'active' : ''--}}" href="{{-- route('admin.car-lead.sell-it') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">List Jual Mobil</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif -->

        {{-- Partner Data Verification --}}
        <!-- @if (checkPerm('admin-seller-verification-index'))
            @php
            $userClass = request()->routeIs('admin.shop-verifications.*') ||  request()->routeIs('admin.mechanic-verifications.*') ||  request()->routeIs('admin.verified-sellers.*') ? true : false ;
            @endphp
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $userClass ? 'hover show' : '' --}}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            {{-- <i class="nav-icon far fa-user"></i> --}}
                            <i class="fa-solid fa-building-circle-check"></i>
                        </span>
                    </span>
                    <span class="menu-title">Partner Data Verification</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $userClass ? 'show' : '' --}}">
                    <div class="menu-item">
                        <a class="menu-link {{-- request()->routeIs('admin.shop-verifications.*') ? 'active' : ''--}}" href="{{-- route('admin.shop-verifications.index') --}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Verification Request Toko</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{-- request()->routeIs('admin.mechanic-verifications.*') ? 'active' : ''--}}" href="{{-- route('admin.mechanic-verifications.index') --}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Verification Request Individu</span>
                        </a>
                    </div>
                    <div class="menu-item">
                        <a class="menu-link {{-- request()->routeIs('admin.verified-sellers.*') ? 'active' : ''--}}" href="{{-- route('admin.verified-sellers.index') --}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">Verified Partners</span>
                        </a>
                    </div>
                </div>
            </div>
        @endif -->

        {{-- Dealer Data Management --}}
        <!-- @if (checkPerm('admin-dealer-index'))
            @php
                $dealerDataClass = request()->routeIs('admin.dealers.*');
            @endphp
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $dealerDataClass ? 'hover show' : '' --}}">
                <div class="menu-item">
                    <a class="menu-link {{-- request()->routeIs('admin.dealers.*') ? 'active' : ''--}}" href="{{-- route('admin.dealers.index') --}}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <i class="fa-solid fa-shop"></i>
                            </span>
                        </span>
                        <span class="menu-title">Dealer Data Management</span>
                    </a>
                </div>
            </div>
        @endif -->

        {{-- Product Management --}}
        <!-- @if (checkPerm('admin-car-brand-index') || checkPerm('admin-car-type-index') || checkPerm('admin-car-model-index') || checkPerm('admin-unit-index') || checkPerm('admin-service-index') || checkPerm('admin-sparepart-index') || checkPerm('admin-year-index'))
            @php
                $productManagementClass = request()->routeIs('admin.car-brands.*') || request()->routeIs('admin.car-types.*') || request()->routeIs('admin.car-models.*') || request()->routeIs('admin.used-cars.*') || request()->routeIs('admin.services.*') || request()->routeIs('admin.years.*') ? true : false ;
            @endphp
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $productManagementClass ? 'hover show' : '' --}}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fa-solid fa-suitcase"></i>
                        </span>
                    </span>
                    <span class="menu-title">Product Management</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $productManagementClass ? 'show' : '' --}}">
                    @if (checkPerm('admin-unit-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.used-cars.*') ? 'active' : ''--}}" href="{{-- route('admin.used-cars.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">List Unit</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-service-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.services.*')  && request()['inactive'] != 1 ? 'active' : ''--}}" href="{{-- route('admin.services.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">List Servis & Spare Part</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-service-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.services.*') && request()['inactive'] == 1 ? 'active' : ''--}}" href="{{-- route('admin.services.index', ['inactive' => 1]) --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Product Bermasalah</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-car-brand-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.car-brands.*') ? 'active' : ''--}}" href="{{-- route('admin.car-brands.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Manage Brand Mobil</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-car-type-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.car-types.*') ? 'active' : ''--}}" href="{{-- route('admin.car-types.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Manage Tipe Mobil</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-car-model-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.car-models.*') ? 'active' : ''--}}" href="{{-- route('admin.car-models.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Manage Model Mobil</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-year-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.years.*') ? 'active' : ''--}}" href="{{-- route('admin.years.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Manage Year</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif -->

        {{-- Promotion Management --}}
        <!-- @if (checkPerm('admin-promo-index'))
            @php
                $promoClass = request()->routeIs('admin.promos.*')   ? true : false ;
            @endphp
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $promoClass ? 'hover show' : '' --}}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fa-solid fa-tags"></i>
                        </span>
                    </span>
                    <span class="menu-title">Promotion Management</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $promoClass ? 'show' : '' --}}">
                    @if (checkPerm('admin-promo-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.promos.*') ? 'active' : ''--}}" href="{{-- route('admin.promos.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">List Promo &amp; Code</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif -->

        {{-- FAQ --}}
        <!-- @if (checkPerm('admin-faq-index'))
            @php
                $faqClass = request()->routeIs('admin.faqs.*')   ? true : false ;
            @endphp
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $faqClass ? 'hover show' : '' --}}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fa-solid fa-circle-question"></i>
                        </span>
                    </span>
                    <span class="menu-title">FAQ</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $faqClass ? 'show' : '' --}}">
                    <div class="menu-item">
                        <a class="menu-link {{-- request()->routeIs('admin.faqs.index') ? 'active' : ''--}}" href="{{-- route('admin.faqs.index') --}}">
                            <span class="menu-bullet">
                                <span class="bullet bullet-dot"></span>
                            </span>
                            <span class="menu-title">FAQ</span>
                        </a>
                    </div>
                </div>
            </div>
        @endif -->

        {{-- Pengaduan & Komplain --}}
        <!-- @if (checkPerm('admin-complaint-index') || checkPerm('admin-order-complaint-index'))
            @php
                // $complaintClass = request()->routeIs('admin.complaint.*') || request()->routeIs('admin.order-complaints.*') ? true : false ;
            @endphp
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $complaintClass ? 'hover show' : '' --}}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fa-solid fa-headset"></i>
                        </span>
                    </span>
                    <span class="menu-title">Pengaduan & Komplain</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $complaintClass ? 'show' : '' --}}">
                    @if (checkPerm('admin-complaint-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.complaint.*') ? 'active' : ''--}}" href="{{-- route('admin.complaint.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">List Feedback</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-order-complaint-index'))
                        @php
                            //$orderComplaintClass = request()->routeIs('admin.order-complaints.*') ? true : false ;
                            //$orderComplaintCategories = \App\Models\ComplaintCategory::where('type', 'order')->get();
                        @endphp
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $orderComplaintClass ? 'hover show' : '' --}}">
                            <span class="menu-link">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">List Feedback Complain</span>
                                <span class="menu-arrow"></span>
                            </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $orderComplaintClass ? 'show' : '' --}}">
                                {{-- @foreach ($orderComplaintCategories as $category) --}}
                                <div class="menu-item">
                                    <a class="menu-link {{-- request()->routeIs('admin.order-complaints.*') && request()['category'] == $category->id ? 'active' : ''--}}"
                                        href="{{-- route('admin.order-complaints.index', ['category' => $category->id]) --}}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot"></span>
                                        </span>
                                        <span class="menu-title">{{-- $category->name --}}</span>
                                    </a>
                                </div>
                                {{-- @endforeach --}}
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif -->

        {{-- Chat Diskusi --}}
        <!-- @if (checkPerm('admin-chat-history-index') || checkPerm('admin-forum-discussion-index'))
            @php
                $chatDiscussionClass = request()->routeIs('admin.chat-histories.*') || request()->routeIs('admin.forum-discussions.*');
            @endphp
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $chatDiscussionClass ? 'hover show' : '' --}}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fa-solid fa-shapes"></i>
                        </span>
                    </span>
                    <span class="menu-title">Chat Diskusi</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $chatDiscussionClass ? 'show' : '' --}}">
                    @if (checkPerm('admin-chat-history-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.chat-histories.*') ? 'active' : ''--}}" href="{{-- route('admin.chat-histories.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">History Chat Diskusi</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-forum-discussion-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.forum-discussions.*') ? 'active' : ''--}}" href="{{-- route('admin.forum-discussions.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">List Forum</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif -->

        {{-- Management Page --}}
        <!-- @if (checkPerm('admin-page-index') || checkPerm('admin-page-section-index') || checkPerm('admin-banner-index') || checkPerm('admin-popup-index') || checkPerm('admin-pdp-banner-index') || checkPerm('admin-section-banner-index') || checkPerm('admin-slider-index') || checkPerm('admin-setting-index'))
            @php
                $managementPageClass = request()->routeIs('admin.pages.*') || request()->routeIs('admin.page-sections.*') || request()->routeIs('admin.banner.*') || request()->routeIs('admin.popup.*') || request()->routeIs('admin.pdp-banner.*') || request()->routeIs('admin.section-banner.*') || request()->routeIs('admin.slider.*') || request()->routeIs('admin.setting.*');
            @endphp
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $managementPageClass ? 'hover show' : '' --}}">
                <span class="menu-link">
                    <span class="menu-icon">
                        <span class="svg-icon svg-icon-2">
                            <i class="fa-solid fa-gears"></i>
                        </span>
                    </span>
                    <span class="menu-title">Management Page</span>
                    <span class="menu-arrow"></span>
                </span>
                <div class="menu-sub menu-sub-accordion menu-active-bg {{-- $managementPageClass ? 'show' : '' --}}">
                    @if (checkPerm('admin-page-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.pages.*') ? 'active' : ''--}}" href="{{-- route('admin.pages.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Manage Page</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-page-section-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.page-sections.*') ? 'active' : ''--}}" href="{{-- route('admin.page-sections.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Manage Page Sections</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-banner-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.banner.*') ? 'active' : ''--}}" href="{{-- route('admin.banner.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Manage Banner</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-popup-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.popup.*') ? 'active' : ''--}}" href="{{-- route('admin.popup.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Manage Pop up</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-pdp-banner-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.pdp-banner.*') ? 'active' : ''--}}" href="{{-- route('admin.pdp-banner.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Manage PDP Banner</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-section-banner-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.section-banner.*') ? 'active' : ''--}}" href="{{-- route('admin.section-banner.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Manage Section Banner</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-slider-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.slider.*') ? 'active' : ''--}}" href="{{-- route('admin.slider.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Manage Slider</span>
                            </a>
                        </div>
                    @endif
                    @if (checkPerm('admin-setting-index'))
                        <div class="menu-item">
                            <a class="menu-link {{-- request()->routeIs('admin.setting.*') ? 'active' : ''--}}" href="{{-- route('admin.setting.index') --}}">
                                <span class="menu-bullet">
                                    <span class="bullet bullet-dot"></span>
                                </span>
                                <span class="menu-title">Settings</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        @endif -->

        {{-- Leads Distribution Management --}}
        <!-- @if (checkPerm('admin-leads-distribution-index'))
            @php
                $leadsDistributionManagementClass = request()->routeIs('admin.leads-distribution.*');
            @endphp
            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{-- $leadsDistributionManagementClass ? 'hover show' : '' --}}">
                <div class="menu-item">
                    <a class="menu-link {{-- request()->routeIs('admin.leads-distribution.*') ? 'active' : ''--}}" href="{{-- route('admin.leads-distribution.index') --}}">
                        <span class="menu-icon">
                            <span class="svg-icon svg-icon-2">
                                <i class="fa-solid fa-bars-progress"></i>
                            </span>
                        </span>
                        <span class="menu-title">Leads Distribution Management</span>
                    </a>
                </div>
            </div>
        @endif -->

        <div class="menu-item">
            <div class="menu-content">
                <div class="separator mx-1 my-4"></div>
            </div>
        </div>

    </div>
    {{--end::Menu--}}
</div>
{{--end::Aside Menu--}}
