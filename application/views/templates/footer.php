<!-- Footer untuk desktop -->
<div class="d-md-block d-none">
    <footer class="footer">
        <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">
                Copyright © <span id="currentYear"></span>
                made with <i class="fa fa-heart"></i> by
                <a href="https://e-iuran.kanpa.co.id/" class="font-weight-bold" target="_blank">E-iuran (Beta Vers)</a>
                . All rights reserved.
            </span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">
                <a href="https://kanpa.co.id/" class="font-weight-bold" target="_blank">Supported by Kanpa.co.id</a>
            </span>
        </div>
    </footer>
</div>
<!-- akhir Footer untuk desktop -->

<?php if ($userdata->role == 'Warga') : ?>
<div div class="d-lg-none">
    <center>
        <div class="list-container">
            <button class="more-button" aria-label="Menu Button">
                <div class="menu-icon-wrapper">
                    <div class="menu-icon-line half first"></div>
                    <div class="menu-icon-line"></div>
                    <div class="menu-icon-line half last"></div>
                </div>
            </button>
            <ul class="more-button-list">
                <a href="<?php echo site_url('Dashboard'); ?> ">
                    <li class="more-button-list-item">
                        <svg fill="#000000" height="800px" width="800px" version="1.1"
                            xmlns="http://www.w3.org/2000/svg" viewBox="0 0 297 297"
                            xmlns:xlink="http://www.w3.org/1999/xlink" enable-background="new 0 0 297 297">
                            <g>
                                <path
                                    d="m294.321,129.816l-140.256-126.371c-3.079-2.774-7.757-2.776-10.838-0.006l-140.543,126.371c-2.494,2.244-3.348,5.792-2.147,8.925 1.202,3.133 4.208,5.2 7.564,5.2h23.944l111.125-98.928c3.098-2.837 7.85-2.839 10.947,0.001l111.117,98.927h23.664c3.354,0 6.36-2.065 7.563-5.196 1.203-3.131 0.351-6.678-2.14-8.923z" />
                                <path
                                    d="m172.971,149.57c0-13.4-10.902-24.303-24.303-24.303-13.399,0-24.302,10.902-24.302,24.303v11.897h48.604v-11.897z" />
                                <path
                                    d="m107.659,245.007h82.019v-65.313h-82.019v65.313zm41.01-52.148c6.98,0 12.658,5.678 12.658,12.657 0,3.4-1.354,6.486-3.545,8.764v11.994c0,5.033-4.08,9.113-9.113,9.113s-9.113-4.08-9.113-9.113v-11.996c-2.188-2.276-3.543-5.362-3.543-8.762-0.001-6.98 5.677-12.657 12.656-12.657z" />
                                <path
                                    d="m42.077,156.72v130.816c0,4.473 3.627,8.101 8.101,8.101h196.928c4.473,0 8.101-3.628 8.101-8.101v-130.816l-106.563-94.752-106.567,94.752zm149.121-7.15v11.897h7.594c5.034,0 9.113,4.08 9.113,9.113v83.539c0,5.033-4.079,9.113-9.113,9.113h-100.246c-5.033,0-9.113-4.08-9.113-9.113v-83.539c0-5.033 4.08-9.113 9.113-9.113h7.595v-11.897c0-23.451 19.078-42.529 42.528-42.529 23.451,0 42.529,19.078 42.529,42.529z" />
                            </g>
                        </svg>
                        <span>Dashboard</span>
                    </li>
                </a>
                <a href="<?php echo site_url('Profile'); ?> ">
                    <li class="more-button-list-item">
                        <svg fill="#000000" height="800px" width="800px" version="1.1" id="_x31_"
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            viewBox="0 0 128 128" xml:space="preserve">
                            <g>
                                <path d="M65.2,47.6c20.2,0,36.8-14.9,39.6-34.3c-0.4,0.9-1.1,1.5-1.8,2.2c-4.4,4.4-11.7,4.4-16.1,0c-0.7-0.7-1.3-1.5-1.8-2.2
		                        c-4-7-11.6-11.8-20-11.8c-12.6,0-23.1,10.2-23.1,23.1S52.3,47.6,65.2,47.6z" />
                                <path d="M29.5,126.5l4.9-41.1c0.2-1.3,1.3-2.4,2.9-2.4c1.5,0,2.9,1.3,2.9,2.9c0,0.2,0,0.4,0,0.4s-3.2,26-4.9,40.2h60.5
		                        c-1.7-14.2-4.8-40-4.8-40s0-0.2,0-0.4c0-1.5,1.3-2.9,2.9-2.9c1.3,0,2.4,1.1,2.9,2.4l4.9,40.9h19.7l-5.7-48.5
		                        c-2.1-13.9-14-24.7-28.4-24.7H43.4C29,53.3,16.8,64.1,15,78.2l-5.7,48.4H29.5z" />
                            </g>
                        </svg>
                        <span>Profile</span>
                    </li>
                </a>
                <a href="<?php echo site_url('Riwayat_transaksi'); ?> ">
                    <li class="more-button-list-item">
                        <svg width="800px" height="800px" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg">

                            <defs>

                                <style>
                                .cls-1 {
                                    fill: none;
                                    stroke: #000000;
                                    stroke-linecap: round;
                                    stroke-linejoin: round;
                                    stroke-width: 20px;
                                }
                                </style>

                            </defs>

                            <g data-name="Layer 2" id="Layer_2">

                                <g data-name="E425, History, log, manuscript" id="E425_History_log_manuscript">

                                    <path class="cls-1"
                                        d="M75.11,117h0A21.34,21.34,0,0,1,53.83,95.57V31.39A21.34,21.34,0,0,1,75.11,10h0A21.34,21.34,0,0,1,96.39,31.39V95.57A21.34,21.34,0,0,1,75.11,117Z" />

                                    <rect class="cls-1" height="64.17" width="319.22" x="96.39" y="31.39" />

                                    <rect class="cls-1" height="320.87" width="319.22" x="96.39" y="95.57" />

                                    <path class="cls-1"
                                        d="M34.34,39.08H53.83a0,0,0,0,1,0,0v48.8a0,0,0,0,1,0,0H34.34A24.34,24.34,0,0,1,10,63.54v-.13A24.34,24.34,0,0,1,34.34,39.08Z" />

                                    <path class="cls-1"
                                        d="M436.89,117h0a21.34,21.34,0,0,0,21.28-21.39V31.39A21.34,21.34,0,0,0,436.89,10h0a21.34,21.34,0,0,0-21.28,21.39V95.57A21.34,21.34,0,0,0,436.89,117Z" />

                                    <path class="cls-1"
                                        d="M482.51,39.08H502a0,0,0,0,1,0,0v48.8a0,0,0,0,1,0,0H482.51a24.34,24.34,0,0,1-24.34-24.34v-.13a24.34,24.34,0,0,1,24.34-24.34Z"
                                        transform="translate(960.17 126.96) rotate(-180)" />

                                    <path class="cls-1"
                                        d="M75.11,395h0a21.34,21.34,0,0,0-21.28,21.39v64.18A21.34,21.34,0,0,0,75.11,502h0a21.34,21.34,0,0,0,21.28-21.39V416.43A21.34,21.34,0,0,0,75.11,395Z" />

                                    <rect class="cls-1" height="64.17" width="319.22" x="96.39" y="416.43" />

                                    <path class="cls-1"
                                        d="M34.34,424.12H53.83a0,0,0,0,1,0,0v48.8a0,0,0,0,1,0,0H34.34A24.34,24.34,0,0,1,10,448.58v-.13A24.34,24.34,0,0,1,34.34,424.12Z" />

                                    <path class="cls-1"
                                        d="M436.89,395h0a21.34,21.34,0,0,1,21.28,21.39v64.18A21.34,21.34,0,0,1,436.89,502h0a21.34,21.34,0,0,1-21.28-21.39V416.43A21.34,21.34,0,0,1,436.89,395Z" />

                                    <path class="cls-1"
                                        d="M482.51,424.12H502a0,0,0,0,1,0,0v48.8a0,0,0,0,1,0,0H482.51a24.34,24.34,0,0,1-24.34-24.34v-.13a24.34,24.34,0,0,1,24.34-24.34Z"
                                        transform="translate(960.17 897.04) rotate(-180)" />

                                    <line class="cls-1" x1="143.41" x2="256" y1="140.11" y2="140.11" />

                                    <line class="cls-1" x1="143.41" x2="371.26" y1="186.47" y2="186.47" />

                                    <line class="cls-1" x1="143.41" x2="371.26" y1="232.82" y2="232.82" />

                                    <line class="cls-1" x1="143.41" x2="371.26" y1="279.18" y2="279.18" />

                                    <line class="cls-1" x1="143.41" x2="371.26" y1="325.53" y2="325.53" />

                                    <line class="cls-1" x1="256" x2="371.26" y1="371.89" y2="371.89" />

                                </g>
                            </g>
                        </svg>
                        <span>Riwayat</span>
                    </li>
                </a>
            </ul>
        </div>
    </center>
</div>
<?php endif; ?>


</div>
<!-- main-panel ends -->
</div>
<!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->