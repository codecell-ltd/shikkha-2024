<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li class="nav-header">
                <div class="dropdown profile-element">
                    <img alt="image" class="rounded-circle" src="{{ asset('frontend/assets/img/logo/shikkha.jpg') }}"
                        width="40" height="40" />
                    <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                        <span class="block m-t-xs font-bold">Codecell Limited</span>
                        <span class="text-muted text-xs block">Admin </span>
                    </a>
                    <ul class="dropdown-menu animated fadeInRight m-t-xs">
                        <li><a class="dropdown-item" href="profile.html">Profile</a></li>
                        <li><a class="dropdown-item" href="contacts.html">Contacts</a></li>
                        <li><a class="dropdown-item" href="mailbox.html">Mailbox</a></li>
                        <li class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="{{ route('logout') }}">Logout</a></li>
                    </ul>
                </div>
                <div class="logo-element">
                    IN+
                </div>
            </li>
            {{-- class="active"   <span class="fa arrow"></span> --}}
            <li>
                <a href="{{ route('admin') }}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="{{ route('Schools.list') }}"><i class="fa fa-graduation-cap" aria-hidden="true"></i><span
                        class="nav-label">Schools</span></a>
            </li>
            <li>
                <a href="{{ route('featurePage.create') }}"><i class="fa fa-columns" aria-hidden="true"></i><span
                        class="nav-label">Feature Create</span></a>
            </li>
            {{-- <li>
                <a href="{{ route('show.all.School.ForPayment') }}"><i class="fa fa-phone-square" aria-hidden="true"></i><span class="nav-label">school package</span></a>
            </li> --}}
            <li>
                <a href="{{ route('contactus.index') }}"><i class="fa fa-phone-square" aria-hidden="true"></i><span
                        class="nav-label">Contact us</span></a>
            </li>
            {{-- <li>
                <a href="{{ route('pricing.index') }}"><i class="fa fa-money" aria-hidden="true"></i><span
                        class="nav-label">Pricing</span></a>
            </li> --}}
            <li>
                <a href="{{ route('tutorial.index') }}"><i class="fa fa-youtube-play" aria-hidden="true"></i><span
                        class="nav-label">Tutorial</span></a>
            </li>
            <li>
                <a href="{{ route('messagePackage.index') }}"><i class="fa fa-envelope" aria-hidden="true"></i><span
                        class="nav-label">Message Package</span></a>
            </li>
            <li>
                <a href="{{ route('confirm.message.payment.index') }}"><i class="fa fa-cart-plus"
                        aria-hidden="true"></i><span class="nav-label">Sell Message</span></a>
            </li>
            <li>
                <a href="{{ route('confirm.message.payment.index') }}"><i class="fa fa-paypal"
                        aria-hidden="true"></i><span class="nav-label">Payment Info
                    </span></a>
            </li>
            <li>
                <a href="{{ route('AppReleased.List') }}"><i class="fa fa-bell" aria-hidden="true"></i><span
                        class="nav-label">App Released
                    </span></a>
            </li>
            <li>
                <a href="{{ route('AddonList') }}"><i class="fa fa-sitemap" aria-hidden="true"></i> <span
                        class="nav-label">Addon
                    </span></a>
            </li>
            {{-- <li>
                <a href="{{ route('Schools.analysis') }}"><i class="fa-solid fa-chart-line"></i> <span class="nav-label">Analysis </span></a>
            </li> --}}
            <li>
                <a href="{{ route('seo.tool') }}"><i class="fa fa-sitemap" aria-hidden="true"></i> <span
                        class="nav-label">SEO Tools
                    </span></a>
            </li>
            <li>
                <a href="{{ route('under.maintenance.show') }}"><i class="fa fa-cog" aria-hidden="true"></i> <span
                        class="nav-label">Setting
                    </span></a>
            </li>
            <li>
                <a href="{{ route('support.create') }}"><i class="fa fa-paypal" aria-hidden="true"></i><span
                        class="nav-label">Support Departmnet
                    </span></a>
            </li>

            <li>
                <a href="{{ route('ticket.reply.admin') }}"><i class="fa fa-paypal" aria-hidden="true"></i><span
                        class="nav-label">Support </span></a>
            </li>
            <li>

                <a href="{{ route('bloglist') }}"><i class="fa fa-sitemap" aria-hidden="true"></i> <span
                        class="nav-label">Blog</span></a>
            </li>

            <li>
                <a href="{{ route('testimonial.imagelist') }}"><i class="bi bi-images"></i> <span
                        class="nav-label">testimonial image
                    </span></a>
            </li>

        </ul>

    </div>
</nav>
