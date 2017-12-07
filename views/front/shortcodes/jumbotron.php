<div class="shortcode shortcode-jumbotron">
    <div class="jumbotron">
        <svg width="100%" height="450px" viewBox="0 0 1200 300" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <g class="curve" stroke="#D6EFBA" fill="none" fill-rule="evenodd" transform="translate(0,90)">
                <path id="glowPath" d="M 0, 60 S 300, -60, 600, 60, 800, -120, 1200 60"/>
                <path d="M 0, 60 S 200, -60, 400, 60, 900, -120, 1200 60"/>
                <path d="M 0, 60 S 200, -70, 400, 70, 800, -120, 1200 60"/>
                <path d="M 0, 60 S 200, -60, 400, 80, 600, -120, 1200 60"/>
                <path d="M 0, 60 S 300, -60, 600, 60, 800, -120, 1200 60"/>
                <path d="M 0, 60 S 200, -70, 400, 60, 800, -120, 1200 60"/>
            </g>
            <!--    <circle id="glow" r="2" cx="0" cy="90" fill="#fff"></circle>
                <animateMotion xlink:href="#glow" dur="6s" begin="1.2s" count="indefinite">
                  <mpath xlink:href="#glowPath" />
                </animateMotion>-->
        </svg>
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6">

                </div>
                <div class="col-lg-6">
                    <?php echo $content;?>
                </div>
            </div>
        </div>
    </div>
</div>