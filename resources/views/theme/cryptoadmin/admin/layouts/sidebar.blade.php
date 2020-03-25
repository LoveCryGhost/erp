<aside class="main-sidebar">
    <!-- sidebar-->
    <section class="sidebar">

        <div class="user-profile">
            <div class="ulogo">
                <a href="../index.html">
                    <!-- logo for regular state and mobile devices -->
                    <h3><b>Crypto</b>Admin</h3>
                </a>
            </div>
            <div class="profile-pic">
                <img src="{{Auth::guard('admin')->user()->avatar}}" alt="user">
                <div class="profile-info"><h5 class="mt-15">{{Auth::guard('admin')->user()->name}}</h5>
                    <div class="text-center d-inline-block">
                        <a href="" class="link" data-toggle="tooltip" title="" data-original-title="Settings"><i class="ion ion-gear-b"></i></a>
                        <a href="" class="link px-15" data-toggle="tooltip" title="" data-original-title="Email"><i class="ion ion-android-mail"></i></a>
                        <a href="" class="link" data-toggle="tooltip" title="" data-original-title="Logout"><i class="ion ion-power"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- sidebar menu-->
        <ul class="sidebar-menu" data-widget="tree">

            <li class="header nav-small-cap">PERSONAL</li>
            <li class="treeview">
                <a href="#">
                    <i class="ti-user"></i>
                    <span>會員</span>
                    <span class="pull-right-container">
                      <i class="fa fa-angle-right pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{route('admin.user.index')}}"><i class="ti-more"></i>User - 清單</a></li>
                    <li><a href="{{route('admin.member.index')}}"><i class="ti-more"></i>Member - 清單</a></li>
                    <li><a href="{{route('admin.staff.index')}}"><i class="ti-more"></i>Staff - 清單</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="ti-dashboard"></i>
                    <span>Dashboard</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="../index.html"><i class="ti-more"></i>Dashboard 1</a></li>
                    <li><a href="../index-2.html"><i class="ti-more"></i>Dashboard 2</a></li>
                    <li><a href="../index-3.html"><i class="ti-more"></i>Dashboard 3</a></li>
                    <li><a href="../index-4.html"><i class="ti-more"></i>Dashboard 4</a></li>
                    <li><a href="../index-5.html"><i class="ti-more"></i>Dashboard 5</a></li>
                    <li><a href="../index-6.html"><i class="ti-more"></i>Dashboard 6</a></li>
                    <li><a href="../index-7.html"><i class="ti-more"></i>Dashboard 7</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="ti-bar-chart"></i>
                    <span>Reports</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="reports_transactions.html"><i class="ti-more"></i>Transactions</a></li>
                    <li><a href="reports_top_gainers_losers.html"><i class="ti-more"></i>Top Gainers/Losers</a></li>
                    <li><a href="reports_market_capitalizations.html"><i class="ti-more"></i>Market Capitalizations</a></li>
                    <li><a href="reports_crypto_stats.html"><i class="ti-more"></i>Crypto Stats</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="ti-pie-chart"></i>
                    <span>Initial Coin Offering</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="ico_distribution_countdown.html"><i class="ti-more"></i>Countdown</a></li>
                    <li><a href="ico_roadmap_timeline.html"><i class="ti-more"></i>Roadmap/Timeline</a></li>
                    <li><a href="ico_progress.html"><i class="ti-more"></i>Progress Bar</a></li>
                    <li><a href="ico_details.html"><i class="ti-more"></i>Details</a></li>
                    <li><a href="ico_listing.html"><i class="ti-more"></i>ICO Listing</a></li>
                    <li><a href="ico_filter.html"><i class="ti-more"></i>ICO Listing - Filters</a></li>
                </ul>
            </li>
            <li>
                <a href="currency_exchange.html">
                    <i class="ti-reload"></i>
                    <span>Currency Exchange</span>
                </a>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="ti-panel"></i>
                    <span>Tickers</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="tickers.html"><i class="ti-more"></i>Ticker</a></li>
                    <li><a href="tickers_live_pricing.html"><i class="ti-more"></i>Live Crypto Prices</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="ti-wallet"></i>
                    <span>Transactions</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="transactions_tables.html"><i class="ti-more"></i>Transactions Tables</a></li>
                    <li><a href="transaction_search.html"><i class="ti-more"></i>Transactions Search</a></li>
                    <li><a href="transaction_details.html"><i class="ti-more"></i>Single Transaction</a></li>
                    <li><a href="transactions_counter.html"><i class="ti-more"></i>Transactions Counter</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="ti-stats-up"></i>
                    <span>Charts</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="charts_chartjs.html"><i class="ti-more"></i>ChartJS</a></li>
                    <li><a href="charts_flot.html"><i class="ti-more"></i>Flot</a></li>
                    <li><a href="charts_inline.html"><i class="ti-more"></i>Inline charts</a></li>
                    <li><a href="charts_morris.html"><i class="ti-more"></i>Morris</a></li>
                    <li><a href="charts_peity.html"><i class="ti-more"></i>Peity</a></li>
                    <li><a href="charts_chartist.html"><i class="ti-more"></i>Chartist</a></li>
                    <li><a href="charts_rickshaw.html"><i class="ti-more"></i>Rickshaw Charts</a></li>
                    <li><a href="charts_nvd3.html"><i class="ti-more"></i>NVD3 Charts</a></li>
                    <li><a href="charts_echart.html"><i class="ti-more"></i>eChart</a></li>

                    <li><a href="charts_amcharts.html"><i class="ti-more"></i>amCharts Charts</a></li>
                    <li><a href="charts_amstock_charts.html"><i class="ti-more"></i>amCharts Stock Charts</a></li>
                    <li><a href="charts_ammaps.html"><i class="ti-more"></i>amCharts Maps</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="ti-files"></i>
                    <span>Layout Options</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="layout_boxed.html"><i class="ti-more"></i>Boxed</a></li>
                    <li><a href="layout_fixed.html"><i class="ti-more"></i>Fixed</a></li>
                    <li><a href="layout_collapsed_sidebar.html"><i class="ti-more"></i>Mini Sidebar</a></li>
                </ul>
            </li>
            <li class="treeview active">
                <a href="#">
                    <i class="ti-user"></i>
                    <span>Apps</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="active"><a href="app_chat.html"><i class="ti-more"></i>Chat app</a></li>
                    <li><a href="app_contact.html"><i class="ti-more"></i>Contact / Employee</a></li>
                    <li><a href="app_userlist_grid.html"><i class="ti-more"></i>Userlist Grid</a></li>
                    <li><a href="app_userlist.html"><i class="ti-more"></i>Userlist</a></li>
                    <li><a href="app_ticket.html"><i class="ti-more"></i>Support Ticket</a></li>
                    <li><a href="app_calendar.html"><i class="ti-more"></i>Calendar</a></li>
                    <li><a href="app_profile.html"><i class="ti-more"></i>Profile</a></li>
                    <li><a href="app_taskboard.html"><i class="ti-more"></i>Project DashBoard</a></li>
                    <li><a href="app_project_table.html"><i class="ti-more"></i>Project</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="ti-email"></i> <span>Mailbox</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="mailbox_inbox.html"><i class="ti-more"></i>Inbox</a></li>
                    <li><a href="mailbox_compose.html"><i class="ti-more"></i>Compose</a></li>
                    <li><a href="mailbox_read_mail.html"><i class="ti-more"></i>Read</a></li>
                </ul>
            </li>

            <li class="header nav-small-cap">UI & COMPONENTS</li>

            <li class="treeview">
                <a href="#">
                    <i class="ti-pencil-alt"></i>
                    <span>UI Components</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="ui_badges.html"><i class="ti-more"></i>Badges</a></li>
                    <li><a href="ui_border_utilities.html"><i class="ti-more"></i>Border</a></li>
                    <li><a href="ui_buttons.html"><i class="ti-more"></i>Buttons</a></li>
                    <li><a href="ui_color_utilities.html"><i class="ti-more"></i>Color</a></li>
                    <li><a href="ui_dropdown.html"><i class="ti-more"></i>Dropdown</a></li>
                    <li><a href="ui_dropdown_grid.html"><i class="ti-more"></i>Dropdown Grid</a></li>
                    <li><a href="ui_typography.html"><i class="ti-more"></i>Typography</a></li>
                    <li><a href="ui_progress_bars.html"><i class="ti-more"></i>Progress Bars</a></li>
                    <li><a href="ui_grid.html"><i class="ti-more"></i>Grid</a></li>
                    <li><a href="ui_ribbons.html"><i class="ti-more"></i>Ribbons</a></li>
                    <li><a href="ui_sliders.html"><i class="ti-more"></i>Sliders</a></li>
                    <li><a href="ui_tab.html"><i class="ti-more"></i>Tabs</a></li>
                    <li><a href="ui_timeline.html"><i class="ti-more"></i>Timeline</a></li>
                    <li><a href="ui_timeline_horizontal.html"><i class="ti-more"></i>Horizontal Timeline</a></li>
                    <li class="treeview">
                        <a href="#"><i class="ti-more"></i>Components
                            <span class="pull-right-container">
				  <i class="fa fa-angle-right pull-right"></i>
				</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="component_bootstrap_switch.html"><i class="ti-more"></i>Bootstrap Switch</a></li>
                            <li><a href="component_date_paginator.html"><i class="ti-more"></i>Date Paginator</a></li>
                            <li><a href="component_media_advanced.html"><i class="ti-more"></i>Advanced Medias</a></li>
                            <li><a href="component_modals.html"><i class="ti-more"></i>Modals</a></li>
                            <li><a href="component_nestable.html"><i class="ti-more"></i>Nestable</a></li>
                            <li><a href="component_notification.html"><i class="ti-more"></i>Notification</a></li>
                            <li><a href="component_portlet_draggable.html"><i class="ti-more"></i>Draggable Portlets</a></li>
                            <li><a href="component_sweatalert.html"><i class="ti-more"></i>Sweet Alert</a></li>
                            <li><a href="component_rangeslider.html"><i class="ti-more"></i>Range Slider</a></li>
                            <li><a href="component_rating.html"><i class="ti-more"></i>Ratings</a></li>
                            <li><a href="component_animations.html"><i class="ti-more"></i>Animations</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="ti-more"></i>Box Cards
                            <span class="pull-right-container">
				  <i class="fa fa-angle-right pull-right"></i>
				</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="box_cards.html"><i class="ti-more"></i>User Card</a></li>
                            <li><a href="box_advanced.html"><i class="ti-more"></i>Advanced Card</a></li>
                            <li><a href="box_basic.html"><i class="ti-more"></i>Basic Card</a></li>
                            <li><a href="box_color.html"><i class="ti-more"></i>Card Color</a></li>
                            <li><a href="box_group.html"><i class="ti-more"></i>Card Group</a></li>
                        </ul>
                    </li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="ti-smallcap"></i>
                    <span>Icons</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="icons_fontawesome.html"><i class="ti-more"></i>Font Awesome</a></li>
                    <li><a href="icons_glyphicons.html"><i class="ti-more"></i>Glyphicons</a></li>
                    <li><a href="icons_material.html"><i class="ti-more"></i>Material Icons</a></li>
                    <li><a href="icons_themify.html"><i class="ti-more"></i>Themify Icons</a></li>
                    <li><a href="icons_simpleline.html"><i class="ti-more"></i>Simple Line Icons</a></li>
                    <li><a href="icons_cryptocoins.html"><i class="ti-more"></i>Cryptocoins Icons</a></li>
                    <li><a href="icons_flag.html"><i class="ti-more"></i>Flag Icons</a></li>
                    <li><a href="icons_weather.html"><i class="ti-more"></i>Weather Icons</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="ti-palette"></i>
                    <span>Widgets</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="widgets_blog.html"><i class="ti-more"></i>Blog</a></li>
                    <li><a href="widgets_chart.html"><i class="ti-more"></i>Chart</a></li>

                    <li><a href="widgets_list.html"><i class="ti-more"></i>List</a></li>
                    <li><a href="widgets_social.html"><i class="ti-more"></i>Social</a></li>
                    <li><a href="widgets_statistic.html"><i class="ti-more"></i>Statistic</a></li>
                    <li><a href="widgets_weather.html"><i class="ti-more"></i>Weather</a></li>
                    <li><a href="widgets.html"><i class="ti-more"></i>Widgets</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="ti-envelope"></i>
                    <span>Extra Components</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="email_index.html"><i class="ti-more"></i>Emails</a></li>
                    <li class="treeview">
                        <a href="#"><i class="ti-more"></i>Maps
                            <span class="pull-right-container">
				  <i class="fa fa-angle-right pull-right"></i>
				</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="map_google.html"><i class="ti-more"></i>Google Map</a></li>
                            <li><a href="map_vector.html"><i class="ti-more"></i>Vector Map</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="#"><i class="ti-more"></i>Extension
                            <span class="pull-right-container">
				  <i class="fa fa-angle-right pull-right"></i>
				</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="extension_fullscreen.html"><i class="ti-more"></i>Fullscreen</a></li>
                            <li><a href="extension_pace.html"><i class="ti-more"></i>Pace</a></li>
                        </ul>
                    </li>
                </ul>
            </li>


            <li class="header nav-small-cap">FORMS And TABLES</li>


            <li class="treeview">
                <a href="#">
                    <i class="ti-write"></i>
                    <span>Forms</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="forms_advanced.html"><i class="ti-more"></i>Advanced Elements</a></li>
                    <li><a href="forms_code_editor.html"><i class="ti-more"></i>Code Editor</a></li>
                    <li><a href="forms_editor_markdown.html"><i class="ti-more"></i>Markdown</a></li>
                    <li><a href="forms_editors.html"><i class="ti-more"></i>Editors</a></li>
                    <li><a href="forms_validation.html"><i class="ti-more"></i>Form Validation</a></li>
                    <li><a href="forms_wizard.html"><i class="ti-more"></i>Form Wizard</a></li>
                    <li><a href="forms_general.html"><i class="ti-more"></i>General Elements</a></li>
                    <li><a href="forms_mask.html"><i class="ti-more"></i>Formatter</a></li>
                    <li><a href="forms_xeditable.html"><i class="ti-more"></i>Xeditable Editor</a></li>
                    <li><a href="forms_dropzone.html"><i class="ti-more"></i>Dropzone</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="ti-layout-grid4"></i>
                    <span>Tables</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="tables_simple.html"><i class="ti-more"></i>Simple tables</a></li>
                    <li><a href="tables_data.html"><i class="ti-more"></i>Data tables</a></li>
                    <li><a href="tables_editable.html"><i class="ti-more"></i>Editable Tables</a></li>
                    <li><a href="tables_color.html"><i class="ti-more"></i>Table Color</a></li>
                </ul>
            </li>

            <li class="header nav-small-cap">SAMPLE PAGES</li>

            <li class="treeview">
                <a href="#">
                    <i class="ti-shield"></i>
                    <span>Authentication</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="auth_login.html"><i class="ti-more"></i>Login</a></li>
                    <li><a href="auth_register.html"><i class="ti-more"></i>Register</a></li>
                    <li><a href="auth_lockscreen.html"><i class="ti-more"></i>Lockscreen</a></li>
                    <li><a href="auth_user_pass.html"><i class="ti-more"></i>Recover password</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="ti-alert"></i>
                    <span>Error Pages</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="error_404.html"><i class="ti-more"></i>Error 404</a></li>
                    <li><a href="error_500.html"><i class="ti-more"></i>Error 500</a></li>
                    <li><a href="error_maintenance.html"><i class="ti-more"></i>Maintenance</a></li>
                </ul>
            </li>

            <li class="treeview">
                <a href="#">
                    <i class="ti-files"></i>
                    <span>Sample Pages</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="sample_blank.html"><i class="ti-more"></i>Blank</a></li>
                    <li><a href="sample_coming_soon.html"><i class="ti-more"></i>Coming Soon</a></li>
                    <li><a href="sample_custom_scroll.html"><i class="ti-more"></i>Custom Scrolls</a></li>
                    <li><a href="sample_faq.html"><i class="ti-more"></i>FAQ</a></li>
                    <li><a href="sample_gallery.html"><i class="ti-more"></i>Gallery</a></li>
                    <li><a href="sample_lightbox.html"><i class="ti-more"></i>Lightbox Popup</a></li>
                    <li><a href="sample_pricing.html"><i class="ti-more"></i>Pricing</a></li>
                    <li><a href="sample_invoice.html"><i class="ti-more"></i>Invoice</a></li>
                    <li><a href="sample_invoicelist.html"><i class="ti-more"></i>Invoice List</a></li>
                </ul>
            </li>


            <li class="header nav-small-cap">EXTRA</li>

            <li class="treeview">
                <a href="#">
                    <i class="ti-view-list"></i>
                    <span>Multilevel</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-right pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="#">Level One</a></li>
                    <li class="treeview">
                        <a href="#">Level One
                            <span class="pull-right-container">
				  <i class="fa fa-angle-right pull-right"></i>
				</span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="#">Level Two</a></li>
                            <li class="treeview">
                                <a href="#">Level Two
                                    <span class="pull-right-container">
				  		<i class="fa fa-angle-right pull-right"></i>
					</span>
                                </a>
                                <ul class="treeview-menu">
                                    <li><a href="#">Level Three</a></li>
                                    <li><a href="#">Level Three</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li><a href="#">Level One</a></li>
                </ul>
            </li>

            <li>
                <a href="auth_login.html">
                    <i class="ti-power-off"></i>
                    <span>Log Out</span>
                </a>
            </li>

        </ul>
    </section>
</aside>
