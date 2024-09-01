<?php
ob_start(); // Start output buffering
include "../private/initialize.php";
include "../private/shared/navbar.php";

if (!empty($_SESSION["admin_id"])) {
  $admin_id = $_SESSION["admin_id"];
  $query_command = "SELECT * FROM admin WHERE admin_id = $admin_id";
  $result = mysqli_query($database_connection, $query_command);
  $fetch_admin = mysqli_fetch_assoc($result);
} else {
  header("Location: auth_login.php");
  exit; // It's a good practice to call exit after a header redirect
}
ob_end_flush(); // Flush the output buffer
?>

<!-- Content wrapper -->
<div class="content-wrapper">
  <!-- Content -->
  <div class="container-xxl flex-grow-1 container-p-y">
    <h1> Welcome <?php echo htmlspecialchars($fetch_admin['username']); ?></h1>
    <div class="row">
      <div class="col-lg-8 mb-4 order-0">
        <div class="card">
          <div class="d-flex align-items-end row">
            <div class="col-sm-7">
              <div class="card-body">
                <h5 class="card-title text-primary">Congratulations John! 🎉</h5>
                <p class="mb-4">
                  You have done <span class="fw-medium">72%</span> more sales today. Check your new badge in
                  your profile.
                </p>

                <a href="javascript:;" class="btn btn-sm btn-outline-primary">View Badges</a>
              </div>
            </div>
            <div class="col-sm-5 text-center text-sm-left">
              <div class="card-body pb-0 px-0 px-md-4">
                <img src="../bootstrap-config/assets/img/illustrations/man-with-laptop-light.png" height="140" alt="View Badge User" data-app-dark-img="illustrations/man-with-laptop-dark.png" data-app-light-img="illustrations/man-with-laptop-light.png">
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-lg-4 col-md-4 order-1">
        <div class="row">
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="../bootstrap-config/assets/img/icons/unicons/chart-success.png" alt="chart success" class="rounded">
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </div>
                <span class="fw-medium d-block mb-1">Profit</span>
                <h3 class="card-title mb-2">$12,628</h3>
                <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +72.80%</small>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="../bootstrap-config/assets/img/icons/unicons/wallet-info.png" alt="Credit Card" class="rounded">
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt6" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt6">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </div>
                <span>Sales</span>
                <h3 class="card-title text-nowrap mb-1">$4,679</h3>
                <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +28.42%</small>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- Total Revenue -->
      <div class="col-12 col-lg-8 order-2 order-md-3 order-lg-2 mb-4">
        <div class="card">
          <div class="row row-bordered g-0">
            <div class="col-md-8">
              <h5 class="card-header m-0 me-2 pb-3">Total Revenue</h5>
              <div id="totalRevenueChart" class="px-2" style="min-height: 315px;">
                <div id="apexchartsix6mqvsxg" class="apexcharts-canvas apexchartsix6mqvsxg apexcharts-theme-light" style="width: 595px; height: 300px;"><svg id="SvgjsSvg1571" width="595" height="300" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                    <foreignObject x="0" y="0" width="595" height="300">
                      <div class="apexcharts-legend apexcharts-align-left apx-legend-position-top" xmlns="http://www.w3.org/1999/xhtml" style="right: 0px; position: absolute; left: 0px; top: 4px; max-height: 150px;">
                        <div class="apexcharts-legend-series" rel="1" seriesname="2021" data:collapsed="false" style="margin: 2px 10px;"><span class="apexcharts-legend-marker" rel="1" data:collapsed="false" style="background: rgb(105, 108, 255) !important; color: rgb(105, 108, 255); height: 8px; width: 8px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="1" i="0" data:default-text="2021" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">2021</span></div>
                        <div class="apexcharts-legend-series" rel="2" seriesname="2020" data:collapsed="false" style="margin: 2px 10px;"><span class="apexcharts-legend-marker" rel="2" data:collapsed="false" style="background: rgb(3, 195, 236) !important; color: rgb(3, 195, 236); height: 8px; width: 8px; left: -3px; top: 0px; border-width: 0px; border-color: rgb(255, 255, 255); border-radius: 12px;"></span><span class="apexcharts-legend-text" rel="2" i="1" data:default-text="2020" data:collapsed="false" style="color: rgb(55, 61, 63); font-size: 12px; font-weight: 400; font-family: Helvetica, Arial, sans-serif;">2020</span></div>
                      </div>
                    </foreignObject>
                    <g id="SvgjsG1573" class="apexcharts-inner apexcharts-graphical" transform="translate(53.7890625, 52)">
                      <defs id="SvgjsDefs1572">
                        <linearGradient id="SvgjsLinearGradient1577" x1="0" y1="0" x2="0" y2="1">
                          <stop id="SvgjsStop1578" stop-opacity="0.4" stop-color="rgba(216,227,240,0.4)" offset="0"></stop>
                          <stop id="SvgjsStop1579" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                          <stop id="SvgjsStop1580" stop-opacity="0.5" stop-color="rgba(190,209,230,0.5)" offset="1"></stop>
                        </linearGradient>
                        <clipPath id="gridRectMaskix6mqvsxg">
                          <rect id="SvgjsRect1582" width="531.2109375" height="222.73" x="-5" y="-3" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                        </clipPath>
                        <clipPath id="forecastMaskix6mqvsxg"></clipPath>
                        <clipPath id="nonForecastMaskix6mqvsxg"></clipPath>
                        <clipPath id="gridRectMarkerMaskix6mqvsxg">
                          <rect id="SvgjsRect1583" width="525.2109375" height="220.73" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                        </clipPath>
                      </defs>
                      <rect id="SvgjsRect1581" width="24.57137276785714" height="216.73" x="167.5412833077567" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke-dasharray="3" fill="url(#SvgjsLinearGradient1577)" class="apexcharts-xcrosshairs" y2="216.73" filter="none" fill-opacity="0.9" x1="167.5412833077567" x2="167.5412833077567"></rect>
                      <g id="SvgjsG1603" class="apexcharts-xaxis" transform="translate(0, 0)">
                        <g id="SvgjsG1604" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1606" font-family="Helvetica, Arial, sans-serif" x="37.22935267857143" y="245.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                            <tspan id="SvgjsTspan1607">Jan</tspan>
                            <title>Jan</title>
                          </text><text id="SvgjsText1609" font-family="Helvetica, Arial, sans-serif" x="111.68805803571429" y="245.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                            <tspan id="SvgjsTspan1610">Feb</tspan>
                            <title>Feb</title>
                          </text><text id="SvgjsText1612" font-family="Helvetica, Arial, sans-serif" x="186.14676339285717" y="245.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                            <tspan id="SvgjsTspan1613">Mar</tspan>
                            <title>Mar</title>
                          </text><text id="SvgjsText1615" font-family="Helvetica, Arial, sans-serif" x="260.60546875" y="245.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                            <tspan id="SvgjsTspan1616">Apr</tspan>
                            <title>Apr</title>
                          </text><text id="SvgjsText1618" font-family="Helvetica, Arial, sans-serif" x="335.0641741071429" y="245.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                            <tspan id="SvgjsTspan1619">May</tspan>
                            <title>May</title>
                          </text><text id="SvgjsText1621" font-family="Helvetica, Arial, sans-serif" x="409.5228794642858" y="245.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                            <tspan id="SvgjsTspan1622">Jun</tspan>
                            <title>Jun</title>
                          </text><text id="SvgjsText1624" font-family="Helvetica, Arial, sans-serif" x="483.98158482142867" y="245.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                            <tspan id="SvgjsTspan1625">Jul</tspan>
                            <title>Jul</title>
                          </text></g>
                      </g>
                      <g id="SvgjsG1640" class="apexcharts-grid">
                        <g id="SvgjsG1641" class="apexcharts-gridlines-horizontal">
                          <line id="SvgjsLine1643" x1="0" y1="0" x2="521.2109375" y2="0" stroke="#eceef1" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                          <line id="SvgjsLine1644" x1="0" y1="43.346" x2="521.2109375" y2="43.346" stroke="#eceef1" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                          <line id="SvgjsLine1645" x1="0" y1="86.692" x2="521.2109375" y2="86.692" stroke="#eceef1" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                          <line id="SvgjsLine1646" x1="0" y1="130.03799999999998" x2="521.2109375" y2="130.03799999999998" stroke="#eceef1" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                          <line id="SvgjsLine1647" x1="0" y1="173.384" x2="521.2109375" y2="173.384" stroke="#eceef1" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                          <line id="SvgjsLine1648" x1="0" y1="216.73" x2="521.2109375" y2="216.73" stroke="#eceef1" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                        </g>
                        <g id="SvgjsG1642" class="apexcharts-gridlines-vertical"></g>
                        <line id="SvgjsLine1650" x1="0" y1="216.73" x2="521.2109375" y2="216.73" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                        <line id="SvgjsLine1649" x1="0" y1="1" x2="0" y2="216.73" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                      </g>
                      <g id="SvgjsG1584" class="apexcharts-bar-series apexcharts-plot-series">
                        <g id="SvgjsG1585" class="apexcharts-series" seriesName="2021" rel="1" data:realIndex="0">
                          <path id="SvgjsPath1587" d="M 24.94366629464286 118.03800000000001L 24.94366629464286 64.01520000000002Q 24.94366629464286 52.01520000000002 36.94366629464286 52.01520000000002L 31.5150390625 52.01520000000002Q 43.5150390625 52.01520000000002 43.5150390625 64.01520000000002L 43.5150390625 64.01520000000002L 43.5150390625 118.03800000000001Q 43.5150390625 130.038 31.5150390625 130.038L 36.94366629464286 130.038Q 24.94366629464286 130.038 24.94366629464286 118.03800000000001z" fill="rgba(105,108,255,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskix6mqvsxg)" pathTo="M 24.94366629464286 118.03800000000001L 24.94366629464286 64.01520000000002Q 24.94366629464286 52.01520000000002 36.94366629464286 52.01520000000002L 31.5150390625 52.01520000000002Q 43.5150390625 52.01520000000002 43.5150390625 64.01520000000002L 43.5150390625 64.01520000000002L 43.5150390625 118.03800000000001Q 43.5150390625 130.038 31.5150390625 130.038L 36.94366629464286 130.038Q 24.94366629464286 130.038 24.94366629464286 118.03800000000001z" pathFrom="M 24.94366629464286 118.03800000000001L 24.94366629464286 118.03800000000001L 43.5150390625 118.03800000000001L 43.5150390625 118.03800000000001L 43.5150390625 118.03800000000001L 43.5150390625 118.03800000000001L 43.5150390625 118.03800000000001L 24.94366629464286 118.03800000000001" cy="52.01520000000002" cx="96.40237165178573" j="0" val="18" barHeight="78.02279999999999" barWidth="24.57137276785714"></path>
                          <path id="SvgjsPath1588" d="M 99.40237165178573 118.03800000000001L 99.40237165178573 111.69580000000002Q 99.40237165178573 99.69580000000002 111.40237165178573 99.69580000000002L 105.97374441964287 99.69580000000002Q 117.97374441964287 99.69580000000002 117.97374441964287 111.69580000000002L 117.97374441964287 111.69580000000002L 117.97374441964287 118.03800000000001Q 117.97374441964287 130.038 105.97374441964287 130.038L 111.40237165178573 130.038Q 99.40237165178573 130.038 99.40237165178573 118.03800000000001z" fill="rgba(105,108,255,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskix6mqvsxg)" pathTo="M 99.40237165178573 118.03800000000001L 99.40237165178573 111.69580000000002Q 99.40237165178573 99.69580000000002 111.40237165178573 99.69580000000002L 105.97374441964287 99.69580000000002Q 117.97374441964287 99.69580000000002 117.97374441964287 111.69580000000002L 117.97374441964287 111.69580000000002L 117.97374441964287 118.03800000000001Q 117.97374441964287 130.038 105.97374441964287 130.038L 111.40237165178573 130.038Q 99.40237165178573 130.038 99.40237165178573 118.03800000000001z" pathFrom="M 99.40237165178573 118.03800000000001L 99.40237165178573 118.03800000000001L 117.97374441964287 118.03800000000001L 117.97374441964287 118.03800000000001L 117.97374441964287 118.03800000000001L 117.97374441964287 118.03800000000001L 117.97374441964287 118.03800000000001L 99.40237165178573 118.03800000000001" cy="99.69580000000002" cx="170.8610770089286" j="1" val="7" barHeight="30.3422" barWidth="24.57137276785714"></path>
                          <path id="SvgjsPath1589" d="M 173.8610770089286 118.03800000000001L 173.8610770089286 77.01900000000002Q 173.8610770089286 65.01900000000002 185.8610770089286 65.01900000000002L 180.43244977678575 65.01900000000002Q 192.43244977678575 65.01900000000002 192.43244977678575 77.01900000000002L 192.43244977678575 77.01900000000002L 192.43244977678575 118.03800000000001Q 192.43244977678575 130.038 180.43244977678575 130.038L 185.8610770089286 130.038Q 173.8610770089286 130.038 173.8610770089286 118.03800000000001z" fill="rgba(105,108,255,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskix6mqvsxg)" pathTo="M 173.8610770089286 118.03800000000001L 173.8610770089286 77.01900000000002Q 173.8610770089286 65.01900000000002 185.8610770089286 65.01900000000002L 180.43244977678575 65.01900000000002Q 192.43244977678575 65.01900000000002 192.43244977678575 77.01900000000002L 192.43244977678575 77.01900000000002L 192.43244977678575 118.03800000000001Q 192.43244977678575 130.038 180.43244977678575 130.038L 185.8610770089286 130.038Q 173.8610770089286 130.038 173.8610770089286 118.03800000000001z" pathFrom="M 173.8610770089286 118.03800000000001L 173.8610770089286 118.03800000000001L 192.43244977678575 118.03800000000001L 192.43244977678575 118.03800000000001L 192.43244977678575 118.03800000000001L 192.43244977678575 118.03800000000001L 192.43244977678575 118.03800000000001L 173.8610770089286 118.03800000000001" cy="65.01900000000002" cx="245.31978236607145" j="2" val="15" barHeight="65.01899999999999" barWidth="24.57137276785714"></path>
                          <path id="SvgjsPath1590" d="M 248.31978236607145 118.03800000000001L 248.31978236607145 16.334600000000023Q 248.31978236607145 4.334600000000023 260.3197823660714 4.334600000000023L 254.89115513392858 4.334600000000023Q 266.8911551339286 4.334600000000023 266.8911551339286 16.334600000000023L 266.8911551339286 16.334600000000023L 266.8911551339286 118.03800000000001Q 266.8911551339286 130.038 254.89115513392858 130.038L 260.3197823660714 130.038Q 248.31978236607145 130.038 248.31978236607145 118.03800000000001z" fill="rgba(105,108,255,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskix6mqvsxg)" pathTo="M 248.31978236607145 118.03800000000001L 248.31978236607145 16.334600000000023Q 248.31978236607145 4.334600000000023 260.3197823660714 4.334600000000023L 254.89115513392858 4.334600000000023Q 266.8911551339286 4.334600000000023 266.8911551339286 16.334600000000023L 266.8911551339286 16.334600000000023L 266.8911551339286 118.03800000000001Q 266.8911551339286 130.038 254.89115513392858 130.038L 260.3197823660714 130.038Q 248.31978236607145 130.038 248.31978236607145 118.03800000000001z" pathFrom="M 248.31978236607145 118.03800000000001L 248.31978236607145 118.03800000000001L 266.8911551339286 118.03800000000001L 266.8911551339286 118.03800000000001L 266.8911551339286 118.03800000000001L 266.8911551339286 118.03800000000001L 266.8911551339286 118.03800000000001L 248.31978236607145 118.03800000000001" cy="4.334600000000023" cx="319.7784877232143" j="3" val="29" barHeight="125.70339999999999" barWidth="24.57137276785714"></path>
                          <path id="SvgjsPath1591" d="M 322.7784877232143 118.03800000000001L 322.7784877232143 64.01520000000002Q 322.7784877232143 52.01520000000002 334.7784877232143 52.01520000000002L 329.34986049107147 52.01520000000002Q 341.34986049107147 52.01520000000002 341.34986049107147 64.01520000000002L 341.34986049107147 64.01520000000002L 341.34986049107147 118.03800000000001Q 341.34986049107147 130.038 329.34986049107147 130.038L 334.7784877232143 130.038Q 322.7784877232143 130.038 322.7784877232143 118.03800000000001z" fill="rgba(105,108,255,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskix6mqvsxg)" pathTo="M 322.7784877232143 118.03800000000001L 322.7784877232143 64.01520000000002Q 322.7784877232143 52.01520000000002 334.7784877232143 52.01520000000002L 329.34986049107147 52.01520000000002Q 341.34986049107147 52.01520000000002 341.34986049107147 64.01520000000002L 341.34986049107147 64.01520000000002L 341.34986049107147 118.03800000000001Q 341.34986049107147 130.038 329.34986049107147 130.038L 334.7784877232143 130.038Q 322.7784877232143 130.038 322.7784877232143 118.03800000000001z" pathFrom="M 322.7784877232143 118.03800000000001L 322.7784877232143 118.03800000000001L 341.34986049107147 118.03800000000001L 341.34986049107147 118.03800000000001L 341.34986049107147 118.03800000000001L 341.34986049107147 118.03800000000001L 341.34986049107147 118.03800000000001L 322.7784877232143 118.03800000000001" cy="52.01520000000002" cx="394.2371930803572" j="4" val="18" barHeight="78.02279999999999" barWidth="24.57137276785714"></path>
                          <path id="SvgjsPath1592" d="M 397.2371930803572 118.03800000000001L 397.2371930803572 90.02280000000002Q 397.2371930803572 78.02280000000002 409.2371930803572 78.02280000000002L 403.80856584821436 78.02280000000002Q 415.80856584821436 78.02280000000002 415.80856584821436 90.02280000000002L 415.80856584821436 90.02280000000002L 415.80856584821436 118.03800000000001Q 415.80856584821436 130.038 403.80856584821436 130.038L 409.2371930803572 130.038Q 397.2371930803572 130.038 397.2371930803572 118.03800000000001z" fill="rgba(105,108,255,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskix6mqvsxg)" pathTo="M 397.2371930803572 118.03800000000001L 397.2371930803572 90.02280000000002Q 397.2371930803572 78.02280000000002 409.2371930803572 78.02280000000002L 403.80856584821436 78.02280000000002Q 415.80856584821436 78.02280000000002 415.80856584821436 90.02280000000002L 415.80856584821436 90.02280000000002L 415.80856584821436 118.03800000000001Q 415.80856584821436 130.038 403.80856584821436 130.038L 409.2371930803572 130.038Q 397.2371930803572 130.038 397.2371930803572 118.03800000000001z" pathFrom="M 397.2371930803572 118.03800000000001L 397.2371930803572 118.03800000000001L 415.80856584821436 118.03800000000001L 415.80856584821436 118.03800000000001L 415.80856584821436 118.03800000000001L 415.80856584821436 118.03800000000001L 415.80856584821436 118.03800000000001L 397.2371930803572 118.03800000000001" cy="78.02280000000002" cx="468.6958984375001" j="5" val="12" barHeight="52.01519999999999" barWidth="24.57137276785714"></path>
                          <path id="SvgjsPath1593" d="M 471.6958984375001 118.03800000000001L 471.6958984375001 103.02660000000002Q 471.6958984375001 91.02660000000002 483.6958984375001 91.02660000000002L 478.26727120535725 91.02660000000002Q 490.26727120535725 91.02660000000002 490.26727120535725 103.02660000000002L 490.26727120535725 103.02660000000002L 490.26727120535725 118.03800000000001Q 490.26727120535725 130.038 478.26727120535725 130.038L 483.6958984375001 130.038Q 471.6958984375001 130.038 471.6958984375001 118.03800000000001z" fill="rgba(105,108,255,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="0" clip-path="url(#gridRectMaskix6mqvsxg)" pathTo="M 471.6958984375001 118.03800000000001L 471.6958984375001 103.02660000000002Q 471.6958984375001 91.02660000000002 483.6958984375001 91.02660000000002L 478.26727120535725 91.02660000000002Q 490.26727120535725 91.02660000000002 490.26727120535725 103.02660000000002L 490.26727120535725 103.02660000000002L 490.26727120535725 118.03800000000001Q 490.26727120535725 130.038 478.26727120535725 130.038L 483.6958984375001 130.038Q 471.6958984375001 130.038 471.6958984375001 118.03800000000001z" pathFrom="M 471.6958984375001 118.03800000000001L 471.6958984375001 118.03800000000001L 490.26727120535725 118.03800000000001L 490.26727120535725 118.03800000000001L 490.26727120535725 118.03800000000001L 490.26727120535725 118.03800000000001L 490.26727120535725 118.03800000000001L 471.6958984375001 118.03800000000001" cy="91.02660000000002" cx="543.154603794643" j="6" val="9" barHeight="39.011399999999995" barWidth="24.57137276785714"></path>
                        </g>
                        <g id="SvgjsG1594" class="apexcharts-series" seriesName="2020" rel="2" data:realIndex="1">
                          <path id="SvgjsPath1596" d="M 24.94366629464286 154.038L 24.94366629464286 186.3878Q 24.94366629464286 198.3878 36.94366629464286 198.3878L 31.5150390625 198.3878Q 43.5150390625 198.3878 43.5150390625 186.3878L 43.5150390625 186.3878L 43.5150390625 154.038Q 43.5150390625 142.038 31.5150390625 142.038L 36.94366629464286 142.038Q 24.94366629464286 142.038 24.94366629464286 154.038z" fill="rgba(3,195,236,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskix6mqvsxg)" pathTo="M 24.94366629464286 154.038L 24.94366629464286 186.3878Q 24.94366629464286 198.3878 36.94366629464286 198.3878L 31.5150390625 198.3878Q 43.5150390625 198.3878 43.5150390625 186.3878L 43.5150390625 186.3878L 43.5150390625 154.038Q 43.5150390625 142.038 31.5150390625 142.038L 36.94366629464286 142.038Q 24.94366629464286 142.038 24.94366629464286 154.038z" pathFrom="M 24.94366629464286 154.038L 24.94366629464286 154.038L 43.5150390625 154.038L 43.5150390625 154.038L 43.5150390625 154.038L 43.5150390625 154.038L 43.5150390625 154.038L 24.94366629464286 154.038" cy="174.3878" cx="96.40237165178573" j="0" val="-13" barHeight="-56.349799999999995" barWidth="24.57137276785714"></path>
                          <path id="SvgjsPath1597" d="M 99.40237165178573 154.038L 99.40237165178573 208.0608Q 99.40237165178573 220.0608 111.40237165178573 220.0608L 105.97374441964287 220.0608Q 117.97374441964287 220.0608 117.97374441964287 208.0608L 117.97374441964287 208.0608L 117.97374441964287 154.038Q 117.97374441964287 142.038 105.97374441964287 142.038L 111.40237165178573 142.038Q 99.40237165178573 142.038 99.40237165178573 154.038z" fill="rgba(3,195,236,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskix6mqvsxg)" pathTo="M 99.40237165178573 154.038L 99.40237165178573 208.0608Q 99.40237165178573 220.0608 111.40237165178573 220.0608L 105.97374441964287 220.0608Q 117.97374441964287 220.0608 117.97374441964287 208.0608L 117.97374441964287 208.0608L 117.97374441964287 154.038Q 117.97374441964287 142.038 105.97374441964287 142.038L 111.40237165178573 142.038Q 99.40237165178573 142.038 99.40237165178573 154.038z" pathFrom="M 99.40237165178573 154.038L 99.40237165178573 154.038L 117.97374441964287 154.038L 117.97374441964287 154.038L 117.97374441964287 154.038L 117.97374441964287 154.038L 117.97374441964287 154.038L 99.40237165178573 154.038" cy="196.0608" cx="170.8610770089286" j="1" val="-18" barHeight="-78.02279999999999" barWidth="24.57137276785714"></path>
                          <path id="SvgjsPath1598" d="M 173.8610770089286 154.038L 173.8610770089286 169.0494Q 173.8610770089286 181.0494 185.8610770089286 181.0494L 180.43244977678575 181.0494Q 192.43244977678575 181.0494 192.43244977678575 169.0494L 192.43244977678575 169.0494L 192.43244977678575 154.038Q 192.43244977678575 142.038 180.43244977678575 142.038L 185.8610770089286 142.038Q 173.8610770089286 142.038 173.8610770089286 154.038z" fill="rgba(3,195,236,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskix6mqvsxg)" pathTo="M 173.8610770089286 154.038L 173.8610770089286 169.0494Q 173.8610770089286 181.0494 185.8610770089286 181.0494L 180.43244977678575 181.0494Q 192.43244977678575 181.0494 192.43244977678575 169.0494L 192.43244977678575 169.0494L 192.43244977678575 154.038Q 192.43244977678575 142.038 180.43244977678575 142.038L 185.8610770089286 142.038Q 173.8610770089286 142.038 173.8610770089286 154.038z" pathFrom="M 173.8610770089286 154.038L 173.8610770089286 154.038L 192.43244977678575 154.038L 192.43244977678575 154.038L 192.43244977678575 154.038L 192.43244977678575 154.038L 192.43244977678575 154.038L 173.8610770089286 154.038" cy="157.0494" cx="245.31978236607145" j="2" val="-9" barHeight="-39.011399999999995" barWidth="24.57137276785714"></path>
                          <path id="SvgjsPath1599" d="M 248.31978236607145 154.038L 248.31978236607145 190.7224Q 248.31978236607145 202.7224 260.3197823660714 202.7224L 254.89115513392858 202.7224Q 266.8911551339286 202.7224 266.8911551339286 190.7224L 266.8911551339286 190.7224L 266.8911551339286 154.038Q 266.8911551339286 142.038 254.89115513392858 142.038L 260.3197823660714 142.038Q 248.31978236607145 142.038 248.31978236607145 154.038z" fill="rgba(3,195,236,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskix6mqvsxg)" pathTo="M 248.31978236607145 154.038L 248.31978236607145 190.7224Q 248.31978236607145 202.7224 260.3197823660714 202.7224L 254.89115513392858 202.7224Q 266.8911551339286 202.7224 266.8911551339286 190.7224L 266.8911551339286 190.7224L 266.8911551339286 154.038Q 266.8911551339286 142.038 254.89115513392858 142.038L 260.3197823660714 142.038Q 248.31978236607145 142.038 248.31978236607145 154.038z" pathFrom="M 248.31978236607145 154.038L 248.31978236607145 154.038L 266.8911551339286 154.038L 266.8911551339286 154.038L 266.8911551339286 154.038L 266.8911551339286 154.038L 266.8911551339286 154.038L 248.31978236607145 154.038" cy="178.7224" cx="319.7784877232143" j="3" val="-14" barHeight="-60.6844" barWidth="24.57137276785714"></path>
                          <path id="SvgjsPath1600" d="M 322.7784877232143 154.038L 322.7784877232143 151.711Q 322.7784877232143 163.711 334.7784877232143 163.711L 329.34986049107147 163.711Q 341.34986049107147 163.711 341.34986049107147 151.711L 341.34986049107147 151.711L 341.34986049107147 154.038Q 341.34986049107147 142.038 329.34986049107147 142.038L 334.7784877232143 142.038Q 322.7784877232143 142.038 322.7784877232143 154.038z" fill="rgba(3,195,236,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskix6mqvsxg)" pathTo="M 322.7784877232143 154.038L 322.7784877232143 151.711Q 322.7784877232143 163.711 334.7784877232143 163.711L 329.34986049107147 163.711Q 341.34986049107147 163.711 341.34986049107147 151.711L 341.34986049107147 151.711L 341.34986049107147 154.038Q 341.34986049107147 142.038 329.34986049107147 142.038L 334.7784877232143 142.038Q 322.7784877232143 142.038 322.7784877232143 154.038z" pathFrom="M 322.7784877232143 154.038L 322.7784877232143 154.038L 341.34986049107147 154.038L 341.34986049107147 154.038L 341.34986049107147 154.038L 341.34986049107147 154.038L 341.34986049107147 154.038L 322.7784877232143 154.038" cy="139.711" cx="394.2371930803572" j="4" val="-5" barHeight="-21.673" barWidth="24.57137276785714"></path>
                          <path id="SvgjsPath1601" d="M 397.2371930803572 154.038L 397.2371930803572 203.7262Q 397.2371930803572 215.7262 409.2371930803572 215.7262L 403.80856584821436 215.7262Q 415.80856584821436 215.7262 415.80856584821436 203.7262L 415.80856584821436 203.7262L 415.80856584821436 154.038Q 415.80856584821436 142.038 403.80856584821436 142.038L 409.2371930803572 142.038Q 397.2371930803572 142.038 397.2371930803572 154.038z" fill="rgba(3,195,236,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskix6mqvsxg)" pathTo="M 397.2371930803572 154.038L 397.2371930803572 203.7262Q 397.2371930803572 215.7262 409.2371930803572 215.7262L 403.80856584821436 215.7262Q 415.80856584821436 215.7262 415.80856584821436 203.7262L 415.80856584821436 203.7262L 415.80856584821436 154.038Q 415.80856584821436 142.038 403.80856584821436 142.038L 409.2371930803572 142.038Q 397.2371930803572 142.038 397.2371930803572 154.038z" pathFrom="M 397.2371930803572 154.038L 397.2371930803572 154.038L 415.80856584821436 154.038L 415.80856584821436 154.038L 415.80856584821436 154.038L 415.80856584821436 154.038L 415.80856584821436 154.038L 397.2371930803572 154.038" cy="191.7262" cx="468.6958984375001" j="5" val="-17" barHeight="-73.6882" barWidth="24.57137276785714"></path>
                          <path id="SvgjsPath1602" d="M 471.6958984375001 154.038L 471.6958984375001 195.05700000000002Q 471.6958984375001 207.05700000000002 483.6958984375001 207.05700000000002L 478.26727120535725 207.05700000000002Q 490.26727120535725 207.05700000000002 490.26727120535725 195.05700000000002L 490.26727120535725 195.05700000000002L 490.26727120535725 154.038Q 490.26727120535725 142.038 478.26727120535725 142.038L 483.6958984375001 142.038Q 471.6958984375001 142.038 471.6958984375001 154.038z" fill="rgba(3,195,236,0.85)" fill-opacity="1" stroke="#ffffff" stroke-opacity="1" stroke-linecap="round" stroke-width="6" stroke-dasharray="0" class="apexcharts-bar-area" index="1" clip-path="url(#gridRectMaskix6mqvsxg)" pathTo="M 471.6958984375001 154.038L 471.6958984375001 195.05700000000002Q 471.6958984375001 207.05700000000002 483.6958984375001 207.05700000000002L 478.26727120535725 207.05700000000002Q 490.26727120535725 207.05700000000002 490.26727120535725 195.05700000000002L 490.26727120535725 195.05700000000002L 490.26727120535725 154.038Q 490.26727120535725 142.038 478.26727120535725 142.038L 483.6958984375001 142.038Q 471.6958984375001 142.038 471.6958984375001 154.038z" pathFrom="M 471.6958984375001 154.038L 471.6958984375001 154.038L 490.26727120535725 154.038L 490.26727120535725 154.038L 490.26727120535725 154.038L 490.26727120535725 154.038L 490.26727120535725 154.038L 471.6958984375001 154.038" cy="183.05700000000002" cx="543.154603794643" j="6" val="-15" barHeight="-65.01899999999999" barWidth="24.57137276785714"></path>
                        </g>
                        <g id="SvgjsG1586" class="apexcharts-datalabels" data:realIndex="0"></g>
                        <g id="SvgjsG1595" class="apexcharts-datalabels" data:realIndex="1"></g>
                      </g>
                      <line id="SvgjsLine1651" x1="0" y1="0" x2="521.2109375" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                      <line id="SvgjsLine1652" x1="0" y1="0" x2="521.2109375" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                      <g id="SvgjsG1653" class="apexcharts-yaxis-annotations"></g>
                      <g id="SvgjsG1654" class="apexcharts-xaxis-annotations"></g>
                      <g id="SvgjsG1655" class="apexcharts-point-annotations"></g>
                    </g>
                    <g id="SvgjsG1626" class="apexcharts-yaxis" rel="0" transform="translate(15.7890625, 0)">
                      <g id="SvgjsG1627" class="apexcharts-yaxis-texts-g"><text id="SvgjsText1628" font-family="Helvetica, Arial, sans-serif" x="20" y="53.5" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                          <tspan id="SvgjsTspan1629">30</tspan>
                          <title>30</title>
                        </text><text id="SvgjsText1630" font-family="Helvetica, Arial, sans-serif" x="20" y="96.846" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                          <tspan id="SvgjsTspan1631">20</tspan>
                          <title>20</title>
                        </text><text id="SvgjsText1632" font-family="Helvetica, Arial, sans-serif" x="20" y="140.192" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                          <tspan id="SvgjsTspan1633">10</tspan>
                          <title>10</title>
                        </text><text id="SvgjsText1634" font-family="Helvetica, Arial, sans-serif" x="20" y="183.538" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                          <tspan id="SvgjsTspan1635">0</tspan>
                          <title>0</title>
                        </text><text id="SvgjsText1636" font-family="Helvetica, Arial, sans-serif" x="20" y="226.88400000000001" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                          <tspan id="SvgjsTspan1637">-10</tspan>
                          <title>-10</title>
                        </text><text id="SvgjsText1638" font-family="Helvetica, Arial, sans-serif" x="20" y="270.23" text-anchor="end" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-yaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                          <tspan id="SvgjsTspan1639">-20</tspan>
                          <title>-20</title>
                        </text></g>
                    </g>
                    <g id="SvgjsG1574" class="apexcharts-annotations"></g>
                  </svg>
                  <div class="apexcharts-tooltip apexcharts-theme-light" style="left: 233.616px; top: 81.6406px;">
                    <div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">Mar</div>
                    <div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 1; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgba(105, 108, 255, 0.85);"></span>
                      <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                        <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">2021: </span><span class="apexcharts-tooltip-text-y-value">15</span></div>
                        <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                        <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                      </div>
                    </div>
                    <div class="apexcharts-tooltip-series-group" style="order: 2; display: none;"><span class="apexcharts-tooltip-marker" style="background-color: rgba(105, 108, 255, 0.85);"></span>
                      <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                        <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">2021: </span><span class="apexcharts-tooltip-text-y-value">15</span></div>
                        <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                        <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                      </div>
                    </div>
                  </div>
                  <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                    <div class="apexcharts-yaxistooltip-text"></div>
                  </div>
                </div>
              </div>
              <div class="resize-triggers">
                <div class="expand-trigger">
                  <div style="width: 612px; height: 377px;"></div>
                </div>
                <div class="contract-trigger"></div>
              </div>
            </div>
            <div class="col-md-4">
              <div class="card-body">
                <div class="text-center">
                  <div class="dropdown">
                    <button class="btn btn-sm btn-outline-primary dropdown-toggle" type="button" id="growthReportId" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      2022
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="growthReportId">
                      <a class="dropdown-item" href="javascript:void(0);">2021</a>
                      <a class="dropdown-item" href="javascript:void(0);">2020</a>
                      <a class="dropdown-item" href="javascript:void(0);">2019</a>
                    </div>
                  </div>
                </div>
              </div>
              <div id="growthChart" style="min-height: 154.875px;">
                <div id="apexchartssu9it5sk" class="apexcharts-canvas apexchartssu9it5sk apexcharts-theme-light" style="width: 306px; height: 154.875px;"><svg id="SvgjsSvg1656" width="306" height="154.875" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                    <g id="SvgjsG1658" class="apexcharts-inner apexcharts-graphical" transform="translate(46, -25)">
                      <defs id="SvgjsDefs1657">
                        <clipPath id="gridRectMasksu9it5sk">
                          <rect id="SvgjsRect1660" width="222" height="285" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                        </clipPath>
                        <clipPath id="forecastMasksu9it5sk"></clipPath>
                        <clipPath id="nonForecastMasksu9it5sk"></clipPath>
                        <clipPath id="gridRectMarkerMasksu9it5sk">
                          <rect id="SvgjsRect1661" width="220" height="287" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                        </clipPath>
                        <linearGradient id="SvgjsLinearGradient1666" x1="1" y1="0" x2="0" y2="1">
                          <stop id="SvgjsStop1667" stop-opacity="1" stop-color="rgba(105,108,255,1)" offset="0.3"></stop>
                          <stop id="SvgjsStop1668" stop-opacity="0.6" stop-color="rgba(255,255,255,0.6)" offset="0.7"></stop>
                          <stop id="SvgjsStop1669" stop-opacity="0.6" stop-color="rgba(255,255,255,0.6)" offset="1"></stop>
                        </linearGradient>
                        <linearGradient id="SvgjsLinearGradient1677" x1="1" y1="0" x2="0" y2="1">
                          <stop id="SvgjsStop1678" stop-opacity="1" stop-color="rgba(105,108,255,1)" offset="0.3"></stop>
                          <stop id="SvgjsStop1679" stop-opacity="0.6" stop-color="rgba(105,108,255,0.6)" offset="0.7"></stop>
                          <stop id="SvgjsStop1680" stop-opacity="0.6" stop-color="rgba(105,108,255,0.6)" offset="1"></stop>
                        </linearGradient>
                      </defs>
                      <g id="SvgjsG1662" class="apexcharts-radialbar">
                        <g id="SvgjsG1663">
                          <g id="SvgjsG1664" class="apexcharts-tracks">
                            <g id="SvgjsG1665" class="apexcharts-radialbar-track apexcharts-track" rel="1">
                              <path id="apexcharts-radialbarTrack-0" d="M 73.83506097560974 167.17541022773656 A 68.32987804878049 68.32987804878049 0 1 1 142.16493902439026 167.17541022773656" fill="none" fill-opacity="1" stroke="rgba(255,255,255,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="17.357317073170734" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 73.83506097560974 167.17541022773656 A 68.32987804878049 68.32987804878049 0 1 1 142.16493902439026 167.17541022773656"></path>
                            </g>
                          </g>
                          <g id="SvgjsG1671">
                            <g id="SvgjsG1676" class="apexcharts-series apexcharts-radial-series" seriesName="Growth" rel="1" data:realIndex="0">
                              <path id="SvgjsPath1681" d="M 73.83506097560974 167.17541022773656 A 68.32987804878049 68.32987804878049 0 1 1 175.95555982735613 100.85758285229481" fill="none" fill-opacity="0.85" stroke="url(#SvgjsLinearGradient1677)" stroke-opacity="1" stroke-linecap="butt" stroke-width="17.357317073170734" stroke-dasharray="5" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="234" data:value="78" index="0" j="0" data:pathOrig="M 73.83506097560974 167.17541022773656 A 68.32987804878049 68.32987804878049 0 1 1 175.95555982735613 100.85758285229481"></path>
                            </g>
                            <circle id="SvgjsCircle1672" r="54.65121951219512" cx="108" cy="108" class="apexcharts-radialbar-hollow" fill="transparent"></circle>
                            <g id="SvgjsG1673" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;"><text id="SvgjsText1674" font-family="Public Sans" x="108" y="123" text-anchor="middle" dominant-baseline="auto" font-size="15px" font-weight="500" fill="#566a7f" class="apexcharts-text apexcharts-datalabel-label" style="font-family: Public Sans;">Growth</text><text id="SvgjsText1675" font-family="Public Sans" x="108" y="99" text-anchor="middle" dominant-baseline="auto" font-size="22px" font-weight="500" fill="#566a7f" class="apexcharts-text apexcharts-datalabel-value" style="font-family: Public Sans;">78%</text></g>
                          </g>
                        </g>
                      </g>
                      <line id="SvgjsLine1682" x1="0" y1="0" x2="216" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                      <line id="SvgjsLine1683" x1="0" y1="0" x2="216" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                    </g>
                    <g id="SvgjsG1659" class="apexcharts-annotations"></g>
                  </svg>
                  <div class="apexcharts-legend"></div>
                </div>
              </div>
              <div class="text-center fw-medium pt-3 mb-2">62% Company Growth</div>

              <div class="d-flex px-xxl-4 px-lg-2 p-4 gap-xxl-3 gap-lg-1 gap-3 justify-content-between">
                <div class="d-flex">
                  <div class="me-2">
                    <span class="badge bg-label-primary p-2"><i class="bx bx-dollar text-primary"></i></span>
                  </div>
                  <div class="d-flex flex-column">
                    <small>2022</small>
                    <h6 class="mb-0">$32.5k</h6>
                  </div>
                </div>
                <div class="d-flex">
                  <div class="me-2">
                    <span class="badge bg-label-info p-2"><i class="bx bx-wallet text-info"></i></span>
                  </div>
                  <div class="d-flex flex-column">
                    <small>2021</small>
                    <h6 class="mb-0">$41.2k</h6>
                  </div>
                </div>
              </div>
              <div class="resize-triggers">
                <div class="expand-trigger">
                  <div style="width: 307px; height: 377px;"></div>
                </div>
                <div class="contract-trigger"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Total Revenue -->
      <div class="col-12 col-md-8 col-lg-4 order-3 order-md-2">
        <div class="row">
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="../bootstrap-config/assets/img/icons/unicons/paypal.png" alt="Credit Card" class="rounded">
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt4">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </div>
                <span class="d-block mb-1">Payments</span>
                <h3 class="card-title text-nowrap mb-2">$2,456</h3>
                <small class="text-danger fw-medium"><i class="bx bx-down-arrow-alt"></i> -14.82%</small>
              </div>
            </div>
          </div>
          <div class="col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0">
                    <img src="../bootstrap-config/assets/img/icons/unicons/cc-primary.png" alt="Credit Card" class="rounded">
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt1" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="cardOpt1">
                      <a class="dropdown-item" href="javascript:void(0);">View More</a>
                      <a class="dropdown-item" href="javascript:void(0);">Delete</a>
                    </div>
                  </div>
                </div>
                <span class="fw-medium d-block mb-1">Transactions</span>
                <h3 class="card-title mb-2">$14,857</h3>
                <small class="text-success fw-medium"><i class="bx bx-up-arrow-alt"></i> +28.14%</small>
              </div>
            </div>
          </div>
          <!-- </div>
    <div class="row"> -->
          <div class="col-12 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="d-flex justify-content-between flex-sm-row flex-column gap-3" style="position: relative;">
                  <div class="d-flex flex-sm-column flex-row align-items-start justify-content-between">
                    <div class="card-title">
                      <h5 class="text-nowrap mb-2">Profile Report</h5>
                      <span class="badge bg-label-warning rounded-pill">Year 2021</span>
                    </div>
                    <div class="mt-sm-auto">
                      <small class="text-success text-nowrap fw-medium"><i class="bx bx-chevron-up"></i> 68.2%</small>
                      <h3 class="mb-0">$84,686k</h3>
                    </div>
                  </div>
                  <div id="profileReportChart" style="min-height: 80px;">
                    <div id="apexchartsf20e0k2b" class="apexcharts-canvas apexchartsf20e0k2b apexcharts-theme-light" style="width: 260px; height: 80px;"><svg id="SvgjsSvg1685" width="260" height="80" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                        <g id="SvgjsG1687" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 0)">
                          <defs id="SvgjsDefs1686">
                            <clipPath id="gridRectMaskf20e0k2b">
                              <rect id="SvgjsRect1692" width="261" height="85" x="-4.5" y="-2.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                            </clipPath>
                            <clipPath id="forecastMaskf20e0k2b"></clipPath>
                            <clipPath id="nonForecastMaskf20e0k2b"></clipPath>
                            <clipPath id="gridRectMarkerMaskf20e0k2b">
                              <rect id="SvgjsRect1693" width="256" height="84" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                            </clipPath>
                            <filter id="SvgjsFilter1699" filterUnits="userSpaceOnUse" width="200%" height="200%" x="-50%" y="-50%">
                              <feFlood id="SvgjsFeFlood1700" flood-color="#ffab00" flood-opacity="0.15" result="SvgjsFeFlood1700Out" in="SourceGraphic"></feFlood>
                              <feComposite id="SvgjsFeComposite1701" in="SvgjsFeFlood1700Out" in2="SourceAlpha" operator="in" result="SvgjsFeComposite1701Out"></feComposite>
                              <feOffset id="SvgjsFeOffset1702" dx="5" dy="10" result="SvgjsFeOffset1702Out" in="SvgjsFeComposite1701Out"></feOffset>
                              <feGaussianBlur id="SvgjsFeGaussianBlur1703" stdDeviation="3 " result="SvgjsFeGaussianBlur1703Out" in="SvgjsFeOffset1702Out"></feGaussianBlur>
                              <feMerge id="SvgjsFeMerge1704" result="SvgjsFeMerge1704Out" in="SourceGraphic">
                                <feMergeNode id="SvgjsFeMergeNode1705" in="SvgjsFeGaussianBlur1703Out"></feMergeNode>
                                <feMergeNode id="SvgjsFeMergeNode1706" in="[object Arguments]"></feMergeNode>
                              </feMerge>
                              <feBlend id="SvgjsFeBlend1707" in="SourceGraphic" in2="SvgjsFeMerge1704Out" mode="normal" result="SvgjsFeBlend1707Out"></feBlend>
                            </filter>
                          </defs>
                          <line id="SvgjsLine1691" x1="0" y1="0" x2="0" y2="80" stroke="#b6b6b6" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="0" y="0" width="1" height="80" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                          <g id="SvgjsG1708" class="apexcharts-xaxis" transform="translate(0, 0)">
                            <g id="SvgjsG1709" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"></g>
                          </g>
                          <g id="SvgjsG1717" class="apexcharts-grid">
                            <g id="SvgjsG1718" class="apexcharts-gridlines-horizontal" style="display: none;">
                              <line id="SvgjsLine1720" x1="0" y1="0" x2="252" y2="0" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                              <line id="SvgjsLine1721" x1="0" y1="20" x2="252" y2="20" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                              <line id="SvgjsLine1722" x1="0" y1="40" x2="252" y2="40" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                              <line id="SvgjsLine1723" x1="0" y1="60" x2="252" y2="60" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                              <line id="SvgjsLine1724" x1="0" y1="80" x2="252" y2="80" stroke="#e0e0e0" stroke-dasharray="0" stroke-linecap="butt" class="apexcharts-gridline"></line>
                            </g>
                            <g id="SvgjsG1719" class="apexcharts-gridlines-vertical" style="display: none;"></g>
                            <line id="SvgjsLine1726" x1="0" y1="80" x2="252" y2="80" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                            <line id="SvgjsLine1725" x1="0" y1="1" x2="0" y2="80" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                          </g>
                          <g id="SvgjsG1694" class="apexcharts-line-series apexcharts-plot-series">
                            <g id="SvgjsG1695" class="apexcharts-series" seriesName="seriesx1" data:longestSeries="true" rel="1" data:realIndex="0">
                              <path id="SvgjsPath1698" d="M 0 76C 17.64 76 32.760000000000005 12 50.400000000000006 12C 68.04 12 83.16000000000001 62 100.80000000000001 62C 118.44000000000001 62 133.56 22 151.20000000000002 22C 168.84000000000003 22 183.96000000000004 38 201.60000000000002 38C 219.24 38 234.36 6 252 6" fill="none" fill-opacity="1" stroke="rgba(255,171,0,0.85)" stroke-opacity="1" stroke-linecap="butt" stroke-width="5" stroke-dasharray="0" class="apexcharts-line" index="0" clip-path="url(#gridRectMaskf20e0k2b)" filter="url(#SvgjsFilter1699)" pathTo="M 0 76C 17.64 76 32.760000000000005 12 50.400000000000006 12C 68.04 12 83.16000000000001 62 100.80000000000001 62C 118.44000000000001 62 133.56 22 151.20000000000002 22C 168.84000000000003 22 183.96000000000004 38 201.60000000000002 38C 219.24 38 234.36 6 252 6" pathFrom="M -1 120L -1 120L 50.400000000000006 120L 100.80000000000001 120L 151.20000000000002 120L 201.60000000000002 120L 252 120"></path>
                              <g id="SvgjsG1696" class="apexcharts-series-markers-wrap" data:realIndex="0">
                                <g class="apexcharts-series-markers">
                                  <circle id="SvgjsCircle1732" r="0" cx="0" cy="0" class="apexcharts-marker wxeah2w3jk no-pointer-events" stroke="#ffffff" fill="#ffab00" fill-opacity="1" stroke-width="2" stroke-opacity="0.9" default-marker-size="0"></circle>
                                </g>
                              </g>
                            </g>
                            <g id="SvgjsG1697" class="apexcharts-datalabels" data:realIndex="0"></g>
                          </g>
                          <line id="SvgjsLine1727" x1="0" y1="0" x2="252" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                          <line id="SvgjsLine1728" x1="0" y1="0" x2="252" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                          <g id="SvgjsG1729" class="apexcharts-yaxis-annotations"></g>
                          <g id="SvgjsG1730" class="apexcharts-xaxis-annotations"></g>
                          <g id="SvgjsG1731" class="apexcharts-point-annotations"></g>
                        </g>
                        <rect id="SvgjsRect1690" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                        <g id="SvgjsG1716" class="apexcharts-yaxis" rel="0" transform="translate(-18, 0)"></g>
                        <g id="SvgjsG1688" class="apexcharts-annotations"></g>
                      </svg>
                      <div class="apexcharts-legend" style="max-height: 40px;"></div>
                      <div class="apexcharts-tooltip apexcharts-theme-light">
                        <div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;"></div>
                        <div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(255, 171, 0);"></span>
                          <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                            <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                            <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                            <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                          </div>
                        </div>
                      </div>
                      <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                        <div class="apexcharts-yaxistooltip-text"></div>
                      </div>
                    </div>
                  </div>
                  <div class="resize-triggers">
                    <div class="expand-trigger">
                      <div style="width: 398px; height: 117px;"></div>
                    </div>
                    <div class="contract-trigger"></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row">
      <!-- Order Statistics -->
      <div class="col-md-6 col-lg-4 col-xl-4 order-0 mb-4">
        <div class="card h-100">
          <div class="card-header d-flex align-items-center justify-content-between pb-0">
            <div class="card-title mb-0">
              <h5 class="m-0 me-2">Order Statistics</h5>
              <small class="text-muted">42.82k Total Sales</small>
            </div>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="orederStatistics" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="orederStatistics">
                <a class="dropdown-item" href="javascript:void(0);">Select All</a>
                <a class="dropdown-item" href="javascript:void(0);">Refresh</a>
                <a class="dropdown-item" href="javascript:void(0);">Share</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3" style="position: relative;">
              <div class="d-flex flex-column align-items-center gap-1">
                <h2 class="mb-2">8,258</h2>
                <span>Total Orders</span>
              </div>
              <div id="orderStatisticsChart" style="min-height: 137.55px;">
                <div id="apexchartsxw25271w" class="apexcharts-canvas apexchartsxw25271w apexcharts-theme-light" style="width: 130px; height: 137.55px;"><svg id="SvgjsSvg1733" width="130" height="137.55" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                    <g id="SvgjsG1735" class="apexcharts-inner apexcharts-graphical" transform="translate(-7, 0)">
                      <defs id="SvgjsDefs1734">
                        <clipPath id="gridRectMaskxw25271w">
                          <rect id="SvgjsRect1737" width="150" height="173" x="-4.5" y="-2.5" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                        </clipPath>
                        <clipPath id="forecastMaskxw25271w"></clipPath>
                        <clipPath id="nonForecastMaskxw25271w"></clipPath>
                        <clipPath id="gridRectMarkerMaskxw25271w">
                          <rect id="SvgjsRect1738" width="145" height="172" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                        </clipPath>
                      </defs>
                      <g id="SvgjsG1739" class="apexcharts-pie">
                        <g id="SvgjsG1740" transform="translate(0, 0) scale(1)">
                          <circle id="SvgjsCircle1741" r="44.835365853658544" cx="70.5" cy="70.5" fill="transparent"></circle>
                          <g id="SvgjsG1742" class="apexcharts-slices">
                            <g id="SvgjsG1743" class="apexcharts-series apexcharts-pie-series" seriesName="Electronic" rel="1" data:realIndex="0">
                              <path id="SvgjsPath1744" d="M 70.5 10.71951219512195 A 59.78048780487805 59.78048780487805 0 0 1 97.63977353321047 123.7648046533095 L 90.85483014990785 110.44860348998213 A 44.835365853658544 44.835365853658544 0 0 0 70.5 25.664634146341456 L 70.5 10.71951219512195 z" fill="rgba(105,108,255,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="5" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-0" index="0" j="0" data:angle="153" data:startAngle="0" data:strokeWidth="5" data:value="85" data:pathOrig="M 70.5 10.71951219512195 A 59.78048780487805 59.78048780487805 0 0 1 97.63977353321047 123.7648046533095 L 90.85483014990785 110.44860348998213 A 44.835365853658544 44.835365853658544 0 0 0 70.5 25.664634146341456 L 70.5 10.71951219512195 z" stroke="#ffffff"></path>
                            </g>
                            <g id="SvgjsG1745" class="apexcharts-series apexcharts-pie-series" seriesName="Sports" rel="2" data:realIndex="1">
                              <path id="SvgjsPath1746" d="M 97.63977353321047 123.7648046533095 A 59.78048780487805 59.78048780487805 0 0 1 70.5 130.28048780487805 L 70.5 115.33536585365854 A 44.835365853658544 44.835365853658544 0 0 0 90.85483014990785 110.44860348998213 L 97.63977353321047 123.7648046533095 z" fill="rgba(133,146,163,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="5" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-1" index="0" j="1" data:angle="27" data:startAngle="153" data:strokeWidth="5" data:value="15" data:pathOrig="M 97.63977353321047 123.7648046533095 A 59.78048780487805 59.78048780487805 0 0 1 70.5 130.28048780487805 L 70.5 115.33536585365854 A 44.835365853658544 44.835365853658544 0 0 0 90.85483014990785 110.44860348998213 L 97.63977353321047 123.7648046533095 z" stroke="#ffffff"></path>
                            </g>
                            <g id="SvgjsG1747" class="apexcharts-series apexcharts-pie-series" seriesName="Decor" rel="3" data:realIndex="2">
                              <path id="SvgjsPath1748" d="M 70.5 130.28048780487805 A 59.78048780487805 59.78048780487805 0 0 1 10.71951219512195 70.50000000000001 L 25.664634146341456 70.5 A 44.835365853658544 44.835365853658544 0 0 0 70.5 115.33536585365854 L 70.5 130.28048780487805 z" fill="rgba(3,195,236,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="5" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-2" index="0" j="2" data:angle="90" data:startAngle="180" data:strokeWidth="5" data:value="50" data:pathOrig="M 70.5 130.28048780487805 A 59.78048780487805 59.78048780487805 0 0 1 10.71951219512195 70.50000000000001 L 25.664634146341456 70.5 A 44.835365853658544 44.835365853658544 0 0 0 70.5 115.33536585365854 L 70.5 130.28048780487805 z" stroke="#ffffff"></path>
                            </g>
                            <g id="SvgjsG1749" class="apexcharts-series apexcharts-pie-series" seriesName="Fashion" rel="4" data:realIndex="3">
                              <path id="SvgjsPath1750" d="M 10.71951219512195 70.50000000000001 A 59.78048780487805 59.78048780487805 0 0 1 70.48956633664653 10.719513105630845 L 70.4921747524849 25.664634829223125 A 44.835365853658544 44.835365853658544 0 0 0 25.664634146341456 70.5 L 10.71951219512195 70.50000000000001 z" fill="rgba(113,221,55,1)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="5" stroke-dasharray="0" class="apexcharts-pie-area apexcharts-donut-slice-3" index="0" j="3" data:angle="90" data:startAngle="270" data:strokeWidth="5" data:value="50" data:pathOrig="M 10.71951219512195 70.50000000000001 A 59.78048780487805 59.78048780487805 0 0 1 70.48956633664653 10.719513105630845 L 70.4921747524849 25.664634829223125 A 44.835365853658544 44.835365853658544 0 0 0 25.664634146341456 70.5 L 10.71951219512195 70.50000000000001 z" stroke="#ffffff"></path>
                            </g>
                          </g>
                        </g>
                        <g id="SvgjsG1751" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)"><text id="SvgjsText1752" font-family="Helvetica, Arial, sans-serif" x="70.5" y="90.5" text-anchor="middle" dominant-baseline="auto" font-size="0.8125rem" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-datalabel-label" style="font-family: Helvetica, Arial, sans-serif;">Weekly</text><text id="SvgjsText1753" font-family="Public Sans" x="70.5" y="71.5" text-anchor="middle" dominant-baseline="auto" font-size="1.5rem" font-weight="400" fill="#566a7f" class="apexcharts-text apexcharts-datalabel-value" style="font-family: Public Sans;">38%</text></g>
                      </g>
                      <line id="SvgjsLine1754" x1="0" y1="0" x2="141" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                      <line id="SvgjsLine1755" x1="0" y1="0" x2="141" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                    </g>
                    <g id="SvgjsG1736" class="apexcharts-annotations"></g>
                  </svg>
                  <div class="apexcharts-legend"></div>
                  <div class="apexcharts-tooltip apexcharts-theme-dark">
                    <div class="apexcharts-tooltip-series-group" style="order: 1;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(105, 108, 255);"></span>
                      <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                        <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                        <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                        <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                      </div>
                    </div>
                    <div class="apexcharts-tooltip-series-group" style="order: 2;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(133, 146, 163);"></span>
                      <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                        <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                        <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                        <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                      </div>
                    </div>
                    <div class="apexcharts-tooltip-series-group" style="order: 3;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(3, 195, 236);"></span>
                      <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                        <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                        <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                        <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                      </div>
                    </div>
                    <div class="apexcharts-tooltip-series-group" style="order: 4;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(113, 221, 55);"></span>
                      <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                        <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label"></span><span class="apexcharts-tooltip-text-y-value"></span></div>
                        <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                        <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="resize-triggers">
                <div class="expand-trigger">
                  <div style="width: 398px; height: 139px;"></div>
                </div>
                <div class="contract-trigger"></div>
              </div>
            </div>
            <ul class="p-0 m-0">
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-mobile-alt"></i></span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Electronic</h6>
                    <small class="text-muted">Mobile, Earbuds, TV</small>
                  </div>
                  <div class="user-progress">
                    <small class="fw-medium">82.5k</small>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-success"><i class="bx bx-closet"></i></span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Fashion</h6>
                    <small class="text-muted">T-shirt, Jeans, Shoes</small>
                  </div>
                  <div class="user-progress">
                    <small class="fw-medium">23.8k</small>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-info"><i class="bx bx-home-alt"></i></span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Decor</h6>
                    <small class="text-muted">Fine Art, Dining</small>
                  </div>
                  <div class="user-progress">
                    <small class="fw-medium">849k</small>
                  </div>
                </div>
              </li>
              <li class="d-flex">
                <div class="avatar flex-shrink-0 me-3">
                  <span class="avatar-initial rounded bg-label-secondary"><i class="bx bx-football"></i></span>
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <h6 class="mb-0">Sports</h6>
                    <small class="text-muted">Football, Cricket Kit</small>
                  </div>
                  <div class="user-progress">
                    <small class="fw-medium">99</small>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Order Statistics -->

      <!-- Expense Overview -->
      <div class="col-md-6 col-lg-4 order-1 mb-4">
        <div class="card h-100">
          <div class="card-header">
            <ul class="nav nav-pills" role="tablist">
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link active" role="tab" data-bs-toggle="tab" data-bs-target="#navs-tabs-line-card-income" aria-controls="navs-tabs-line-card-income" aria-selected="true">
                  Income
                </button>
              </li>
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link" role="tab" aria-selected="false" tabindex="-1">Expenses</button>
              </li>
              <li class="nav-item" role="presentation">
                <button type="button" class="nav-link" role="tab" aria-selected="false" tabindex="-1">Profit</button>
              </li>
            </ul>
          </div>
          <div class="card-body px-0">
            <div class="tab-content p-0">
              <div class="tab-pane fade show active" id="navs-tabs-line-card-income" role="tabpanel" style="position: relative;">
                <div class="d-flex p-4 pt-3">
                  <div class="avatar flex-shrink-0 me-3">
                    <img src="../assets/img/icons/unicons/wallet.png" alt="User">
                  </div>
                  <div>
                    <small class="text-muted d-block">Total Balance</small>
                    <div class="d-flex align-items-center">
                      <h6 class="mb-0 me-1">$459.10</h6>
                      <small class="text-success fw-medium">
                        <i class="bx bx-chevron-up"></i>
                        42.9%
                      </small>
                    </div>
                  </div>
                </div>
                <div id="incomeChart" style="min-height: 215px;">
                  <div id="apexcharts0zpwn741" class="apexcharts-canvas apexcharts0zpwn741 apexcharts-theme-light" style="width: 445px; height: 215px;"><svg id="SvgjsSvg1756" width="445" height="215" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg apexcharts-zoomable hovering-zoom" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                      <g id="SvgjsG1758" class="apexcharts-inner apexcharts-graphical" transform="translate(0, 10)">
                        <defs id="SvgjsDefs1757">
                          <clipPath id="gridRectMask0zpwn741">
                            <rect id="SvgjsRect1763" width="433.6875" height="175.73" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                          <clipPath id="forecastMask0zpwn741"></clipPath>
                          <clipPath id="nonForecastMask0zpwn741"></clipPath>
                          <clipPath id="gridRectMarkerMask0zpwn741">
                            <rect id="SvgjsRect1764" width="455.6875" height="201.73" x="-14" y="-14" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                          </clipPath>
                          <linearGradient id="SvgjsLinearGradient1784" x1="0" y1="0" x2="0" y2="1">
                            <stop id="SvgjsStop1785" stop-opacity="0.5" stop-color="rgba(105,108,255,0.5)" offset="0"></stop>
                            <stop id="SvgjsStop1786" stop-opacity="0.25" stop-color="rgba(195,196,255,0.25)" offset="0.95"></stop>
                            <stop id="SvgjsStop1787" stop-opacity="0.25" stop-color="rgba(195,196,255,0.25)" offset="1"></stop>
                          </linearGradient>
                        </defs>
                        <line id="SvgjsLine1762" x1="427.1875" y1="0" x2="427.1875" y2="173.73" stroke="#b6b6b6" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-xcrosshairs" x="427.1875" y="0" width="1" height="173.73" fill="#b1b9c4" filter="none" fill-opacity="0.9" stroke-width="1"></line>
                        <g id="SvgjsG1790" class="apexcharts-xaxis" transform="translate(0, 0)">
                          <g id="SvgjsG1791" class="apexcharts-xaxis-texts-g" transform="translate(0, -4)"><text id="SvgjsText1793" font-family="Helvetica, Arial, sans-serif" x="0" y="202.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan1794"></tspan>
                              <title></title>
                            </text><text id="SvgjsText1796" font-family="Helvetica, Arial, sans-serif" x="61.09821428571429" y="202.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan1797">Jan</tspan>
                              <title>Jan</title>
                            </text><text id="SvgjsText1799" font-family="Helvetica, Arial, sans-serif" x="122.19642857142858" y="202.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan1800">Feb</tspan>
                              <title>Feb</title>
                            </text><text id="SvgjsText1802" font-family="Helvetica, Arial, sans-serif" x="183.29464285714286" y="202.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan1803">Mar</tspan>
                              <title>Mar</title>
                            </text><text id="SvgjsText1805" font-family="Helvetica, Arial, sans-serif" x="244.39285714285714" y="202.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan1806">Apr</tspan>
                              <title>Apr</title>
                            </text><text id="SvgjsText1808" font-family="Helvetica, Arial, sans-serif" x="305.4910714285714" y="202.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan1809">May</tspan>
                              <title>May</title>
                            </text><text id="SvgjsText1811" font-family="Helvetica, Arial, sans-serif" x="366.58928571428567" y="202.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan1812">Jun</tspan>
                              <title>Jun</title>
                            </text><text id="SvgjsText1814" font-family="Helvetica, Arial, sans-serif" x="427.68749999999994" y="202.73" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#373d3f" class="apexcharts-text apexcharts-xaxis-label " style="font-family: Helvetica, Arial, sans-serif;">
                              <tspan id="SvgjsTspan1815">Jul</tspan>
                              <title>Jul</title>
                            </text></g>
                        </g>
                        <g id="SvgjsG1818" class="apexcharts-grid">
                          <g id="SvgjsG1819" class="apexcharts-gridlines-horizontal">
                            <line id="SvgjsLine1821" x1="0" y1="0" x2="427.6875" y2="0" stroke="#eceef1" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line>
                            <line id="SvgjsLine1822" x1="0" y1="43.4325" x2="427.6875" y2="43.4325" stroke="#eceef1" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line>
                            <line id="SvgjsLine1823" x1="0" y1="86.865" x2="427.6875" y2="86.865" stroke="#eceef1" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line>
                            <line id="SvgjsLine1824" x1="0" y1="130.29749999999999" x2="427.6875" y2="130.29749999999999" stroke="#eceef1" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line>
                            <line id="SvgjsLine1825" x1="0" y1="173.73" x2="427.6875" y2="173.73" stroke="#eceef1" stroke-dasharray="3" stroke-linecap="butt" class="apexcharts-gridline"></line>
                          </g>
                          <g id="SvgjsG1820" class="apexcharts-gridlines-vertical"></g>
                          <line id="SvgjsLine1827" x1="0" y1="173.73" x2="427.6875" y2="173.73" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                          <line id="SvgjsLine1826" x1="0" y1="1" x2="0" y2="173.73" stroke="transparent" stroke-dasharray="0" stroke-linecap="butt"></line>
                        </g>
                        <g id="SvgjsG1765" class="apexcharts-area-series apexcharts-plot-series">
                          <g id="SvgjsG1766" class="apexcharts-series" seriesName="seriesx1" data:longestSeries="true" rel="1" data:realIndex="0">
                            <path id="SvgjsPath1788" d="M 0 173.73L 0 112.92450000000001C 21.384375 112.92450000000001 39.713839285714286 125.95425 61.098214285714285 125.95425C 82.48258928571428 125.95425 100.81205357142858 86.86500000000001 122.19642857142857 86.86500000000001C 143.58080357142856 86.86500000000001 161.91026785714286 121.611 183.29464285714286 121.611C 204.67901785714287 121.611 223.00848214285713 34.74600000000001 244.39285714285714 34.74600000000001C 265.77723214285714 34.74600000000001 284.10669642857147 104.238 305.49107142857144 104.238C 326.8754464285714 104.238 345.20491071428575 65.14875 366.5892857142857 65.14875C 387.9736607142857 65.14875 406.303125 91.20825 427.6875 91.20825C 427.6875 91.20825 427.6875 91.20825 427.6875 173.73M 427.6875 91.20825z" fill="url(#SvgjsLinearGradient1784)" fill-opacity="1" stroke-opacity="1" stroke-linecap="butt" stroke-width="0" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask0zpwn741)" pathTo="M 0 173.73L 0 112.92450000000001C 21.384375 112.92450000000001 39.713839285714286 125.95425 61.098214285714285 125.95425C 82.48258928571428 125.95425 100.81205357142858 86.86500000000001 122.19642857142857 86.86500000000001C 143.58080357142856 86.86500000000001 161.91026785714286 121.611 183.29464285714286 121.611C 204.67901785714287 121.611 223.00848214285713 34.74600000000001 244.39285714285714 34.74600000000001C 265.77723214285714 34.74600000000001 284.10669642857147 104.238 305.49107142857144 104.238C 326.8754464285714 104.238 345.20491071428575 65.14875 366.5892857142857 65.14875C 387.9736607142857 65.14875 406.303125 91.20825 427.6875 91.20825C 427.6875 91.20825 427.6875 91.20825 427.6875 173.73M 427.6875 91.20825z" pathFrom="M -1 217.1625L -1 217.1625L 61.098214285714285 217.1625L 122.19642857142857 217.1625L 183.29464285714286 217.1625L 244.39285714285714 217.1625L 305.49107142857144 217.1625L 366.5892857142857 217.1625L 427.6875 217.1625"></path>
                            <path id="SvgjsPath1789" d="M 0 112.92450000000001C 21.384375 112.92450000000001 39.713839285714286 125.95425 61.098214285714285 125.95425C 82.48258928571428 125.95425 100.81205357142858 86.86500000000001 122.19642857142857 86.86500000000001C 143.58080357142856 86.86500000000001 161.91026785714286 121.611 183.29464285714286 121.611C 204.67901785714287 121.611 223.00848214285713 34.74600000000001 244.39285714285714 34.74600000000001C 265.77723214285714 34.74600000000001 284.10669642857147 104.238 305.49107142857144 104.238C 326.8754464285714 104.238 345.20491071428575 65.14875 366.5892857142857 65.14875C 387.9736607142857 65.14875 406.303125 91.20825 427.6875 91.20825" fill="none" fill-opacity="1" stroke="#696cff" stroke-opacity="1" stroke-linecap="butt" stroke-width="2" stroke-dasharray="0" class="apexcharts-area" index="0" clip-path="url(#gridRectMask0zpwn741)" pathTo="M 0 112.92450000000001C 21.384375 112.92450000000001 39.713839285714286 125.95425 61.098214285714285 125.95425C 82.48258928571428 125.95425 100.81205357142858 86.86500000000001 122.19642857142857 86.86500000000001C 143.58080357142856 86.86500000000001 161.91026785714286 121.611 183.29464285714286 121.611C 204.67901785714287 121.611 223.00848214285713 34.74600000000001 244.39285714285714 34.74600000000001C 265.77723214285714 34.74600000000001 284.10669642857147 104.238 305.49107142857144 104.238C 326.8754464285714 104.238 345.20491071428575 65.14875 366.5892857142857 65.14875C 387.9736607142857 65.14875 406.303125 91.20825 427.6875 91.20825" pathFrom="M -1 217.1625L -1 217.1625L 61.098214285714285 217.1625L 122.19642857142857 217.1625L 183.29464285714286 217.1625L 244.39285714285714 217.1625L 305.49107142857144 217.1625L 366.5892857142857 217.1625L 427.6875 217.1625"></path>
                            <g id="SvgjsG1767" class="apexcharts-series-markers-wrap" data:realIndex="0">
                              <g id="SvgjsG1769" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMask0zpwn741)">
                                <circle id="SvgjsCircle1770" r="6" cx="0" cy="112.92450000000001" class="apexcharts-marker no-pointer-events wrx85xzir" stroke="transparent" fill="transparent" fill-opacity="1" stroke-width="4" stroke-opacity="0.9" rel="0" j="0" index="0" default-marker-size="6"></circle>
                                <circle id="SvgjsCircle1771" r="6" cx="61.098214285714285" cy="125.95425" class="apexcharts-marker no-pointer-events wqvki8f9x" stroke="transparent" fill="transparent" fill-opacity="1" stroke-width="4" stroke-opacity="0.9" rel="1" j="1" index="0" default-marker-size="6"></circle>
                              </g>
                              <g id="SvgjsG1772" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMask0zpwn741)">
                                <circle id="SvgjsCircle1773" r="6" cx="122.19642857142857" cy="86.86500000000001" class="apexcharts-marker no-pointer-events w2ae2lr58g" stroke="transparent" fill="transparent" fill-opacity="1" stroke-width="4" stroke-opacity="0.9" rel="2" j="2" index="0" default-marker-size="6"></circle>
                              </g>
                              <g id="SvgjsG1774" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMask0zpwn741)">
                                <circle id="SvgjsCircle1775" r="6" cx="183.29464285714286" cy="121.611" class="apexcharts-marker no-pointer-events ww4fd0ogi" stroke="transparent" fill="transparent" fill-opacity="1" stroke-width="4" stroke-opacity="0.9" rel="3" j="3" index="0" default-marker-size="6"></circle>
                              </g>
                              <g id="SvgjsG1776" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMask0zpwn741)">
                                <circle id="SvgjsCircle1777" r="6" cx="244.39285714285714" cy="34.74600000000001" class="apexcharts-marker no-pointer-events wixe463j2" stroke="transparent" fill="transparent" fill-opacity="1" stroke-width="4" stroke-opacity="0.9" rel="4" j="4" index="0" default-marker-size="6"></circle>
                              </g>
                              <g id="SvgjsG1778" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMask0zpwn741)">
                                <circle id="SvgjsCircle1779" r="6" cx="305.49107142857144" cy="104.238" class="apexcharts-marker no-pointer-events wh7nl5u2g" stroke="transparent" fill="transparent" fill-opacity="1" stroke-width="4" stroke-opacity="0.9" rel="5" j="5" index="0" default-marker-size="6"></circle>
                              </g>
                              <g id="SvgjsG1780" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMask0zpwn741)">
                                <circle id="SvgjsCircle1781" r="6" cx="366.5892857142857" cy="65.14875" class="apexcharts-marker no-pointer-events w1dqbovyr" stroke="transparent" fill="transparent" fill-opacity="1" stroke-width="4" stroke-opacity="0.9" rel="6" j="6" index="0" default-marker-size="6"></circle>
                              </g>
                              <g id="SvgjsG1782" class="apexcharts-series-markers" clip-path="url(#gridRectMarkerMask0zpwn741)">
                                <circle id="SvgjsCircle1783" r="6" cx="427.6875" cy="91.20825" class="apexcharts-marker no-pointer-events wsi3yr5yy" stroke="#696cff" fill="#ffffff" fill-opacity="1" stroke-width="4" stroke-opacity="0.9" rel="7" j="7" index="0" default-marker-size="6"></circle>
                              </g>
                            </g>
                          </g>
                          <g id="SvgjsG1768" class="apexcharts-datalabels" data:realIndex="0"></g>
                        </g>
                        <line id="SvgjsLine1828" x1="0" y1="0" x2="427.6875" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                        <line id="SvgjsLine1829" x1="0" y1="0" x2="427.6875" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                        <g id="SvgjsG1830" class="apexcharts-yaxis-annotations"></g>
                        <g id="SvgjsG1831" class="apexcharts-xaxis-annotations"></g>
                        <g id="SvgjsG1832" class="apexcharts-point-annotations"></g>
                        <rect id="SvgjsRect1833" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-zoom-rect"></rect>
                        <rect id="SvgjsRect1834" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe" class="apexcharts-selection-rect"></rect>
                      </g>
                      <rect id="SvgjsRect1761" width="0" height="0" x="0" y="0" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fefefe"></rect>
                      <g id="SvgjsG1816" class="apexcharts-yaxis" rel="0" transform="translate(-8, 0)">
                        <g id="SvgjsG1817" class="apexcharts-yaxis-texts-g"></g>
                      </g>
                      <g id="SvgjsG1759" class="apexcharts-annotations"></g>
                    </svg>
                    <div class="apexcharts-legend" style="max-height: 107.5px;"></div>
                    <div class="apexcharts-tooltip apexcharts-theme-light" style="left: 305.711px; top: 94.7083px;">
                      <div class="apexcharts-tooltip-title" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">Jul</div>
                      <div class="apexcharts-tooltip-series-group apexcharts-active" style="order: 1; display: flex;"><span class="apexcharts-tooltip-marker" style="background-color: rgb(105, 108, 255);"></span>
                        <div class="apexcharts-tooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px;">
                          <div class="apexcharts-tooltip-y-group"><span class="apexcharts-tooltip-text-y-label">series-1: </span><span class="apexcharts-tooltip-text-y-value">29</span></div>
                          <div class="apexcharts-tooltip-goals-group"><span class="apexcharts-tooltip-text-goals-label"></span><span class="apexcharts-tooltip-text-goals-value"></span></div>
                          <div class="apexcharts-tooltip-z-group"><span class="apexcharts-tooltip-text-z-label"></span><span class="apexcharts-tooltip-text-z-value"></span></div>
                        </div>
                      </div>
                    </div>
                    <div class="apexcharts-xaxistooltip apexcharts-xaxistooltip-bottom apexcharts-theme-light" style="left: 406.598px; top: 185.73px;">
                      <div class="apexcharts-xaxistooltip-text" style="font-family: Helvetica, Arial, sans-serif; font-size: 12px; min-width: 19.1797px;">Jul</div>
                    </div>
                    <div class="apexcharts-yaxistooltip apexcharts-yaxistooltip-0 apexcharts-yaxistooltip-left apexcharts-theme-light">
                      <div class="apexcharts-yaxistooltip-text"></div>
                    </div>
                  </div>
                </div>
                <div class="d-flex justify-content-center pt-4 gap-2">
                  <div class="flex-shrink-0" style="position: relative;">
                    <div id="expensesOfWeek" style="min-height: 57.7px;">
                      <div id="apexchartsel7ks8m3" class="apexcharts-canvas apexchartsel7ks8m3 apexcharts-theme-light" style="width: 60px; height: 57.7px;"><svg id="SvgjsSvg1835" width="60" height="57.7" xmlns="http://www.w3.org/2000/svg" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.dev" class="apexcharts-svg" xmlns:data="ApexChartsNS" transform="translate(0, 0)" style="background: transparent;">
                          <g id="SvgjsG1837" class="apexcharts-inner apexcharts-graphical" transform="translate(-10, -10)">
                            <defs id="SvgjsDefs1836">
                              <clipPath id="gridRectMaskel7ks8m3">
                                <rect id="SvgjsRect1839" width="86" height="87" x="-3" y="-1" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                              </clipPath>
                              <clipPath id="forecastMaskel7ks8m3"></clipPath>
                              <clipPath id="nonForecastMaskel7ks8m3"></clipPath>
                              <clipPath id="gridRectMarkerMaskel7ks8m3">
                                <rect id="SvgjsRect1840" width="84" height="89" x="-2" y="-2" rx="0" ry="0" opacity="1" stroke-width="0" stroke="none" stroke-dasharray="0" fill="#fff"></rect>
                              </clipPath>
                            </defs>
                            <g id="SvgjsG1841" class="apexcharts-radialbar">
                              <g id="SvgjsG1842">
                                <g id="SvgjsG1843" class="apexcharts-tracks">
                                  <g id="SvgjsG1844" class="apexcharts-radialbar-track apexcharts-track" rel="1">
                                    <path id="apexcharts-radialbarTrack-0" d="M 40 18.098170731707313 A 21.901829268292687 21.901829268292687 0 1 1 39.99617740968999 18.098171065291247" fill="none" fill-opacity="1" stroke="rgba(236,238,241,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="2.0408536585365864" stroke-dasharray="0" class="apexcharts-radialbar-area" data:pathOrig="M 40 18.098170731707313 A 21.901829268292687 21.901829268292687 0 1 1 39.99617740968999 18.098171065291247"></path>
                                  </g>
                                </g>
                                <g id="SvgjsG1846">
                                  <g id="SvgjsG1850" class="apexcharts-series apexcharts-radial-series" seriesName="seriesx1" rel="1" data:realIndex="0">
                                    <path id="SvgjsPath1851" d="M 40 18.098170731707313 A 21.901829268292687 21.901829268292687 0 1 1 22.2810479140526 52.873572242130095" fill="none" fill-opacity="0.85" stroke="rgba(105,108,255,0.85)" stroke-opacity="1" stroke-linecap="round" stroke-width="4.081707317073173" stroke-dasharray="0" class="apexcharts-radialbar-area apexcharts-radialbar-slice-0" data:angle="234" data:value="65" index="0" j="0" data:pathOrig="M 40 18.098170731707313 A 21.901829268292687 21.901829268292687 0 1 1 22.2810479140526 52.873572242130095"></path>
                                  </g>
                                  <circle id="SvgjsCircle1847" r="18.881402439024395" cx="40" cy="40" class="apexcharts-radialbar-hollow" fill="transparent"></circle>
                                  <g id="SvgjsG1848" class="apexcharts-datalabels-group" transform="translate(0, 0) scale(1)" style="opacity: 1;"><text id="SvgjsText1849" font-family="Helvetica, Arial, sans-serif" x="40" y="45" text-anchor="middle" dominant-baseline="auto" font-size="13px" font-weight="400" fill="#697a8d" class="apexcharts-text apexcharts-datalabel-value" style="font-family: Helvetica, Arial, sans-serif;">$65</text></g>
                                </g>
                              </g>
                            </g>
                            <line id="SvgjsLine1852" x1="0" y1="0" x2="80" y2="0" stroke="#b6b6b6" stroke-dasharray="0" stroke-width="1" stroke-linecap="butt" class="apexcharts-ycrosshairs"></line>
                            <line id="SvgjsLine1853" x1="0" y1="0" x2="80" y2="0" stroke-dasharray="0" stroke-width="0" stroke-linecap="butt" class="apexcharts-ycrosshairs-hidden"></line>
                          </g>
                          <g id="SvgjsG1838" class="apexcharts-annotations"></g>
                        </svg>
                        <div class="apexcharts-legend"></div>
                      </div>
                    </div>
                    <div class="resize-triggers">
                      <div class="expand-trigger">
                        <div style="width: 61px; height: 59px;"></div>
                      </div>
                      <div class="contract-trigger"></div>
                    </div>
                  </div>
                  <div>
                    <p class="mb-n1 mt-1">Expenses This Week</p>
                    <small class="text-muted">$39 less than last week</small>
                  </div>
                </div>
                <div class="resize-triggers">
                  <div class="expand-trigger">
                    <div style="width: 446px; height: 377px;"></div>
                  </div>
                  <div class="contract-trigger"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!--/ Expense Overview -->

      <!-- Transactions -->
      <div class="col-md-6 col-lg-4 order-2 mb-4">
        <div class="card h-100">
          <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title m-0 me-2">Transactions</h5>
            <div class="dropdown">
              <button class="btn p-0" type="button" id="transactionID" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="bx bx-dots-vertical-rounded"></i>
              </button>
              <div class="dropdown-menu dropdown-menu-end" aria-labelledby="transactionID">
                <a class="dropdown-item" href="javascript:void(0);">Last 28 Days</a>
                <a class="dropdown-item" href="javascript:void(0);">Last Month</a>
                <a class="dropdown-item" href="javascript:void(0);">Last Year</a>
              </div>
            </div>
          </div>
          <div class="card-body">
            <ul class="p-0 m-0">
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="../bootstrap-config/assets/img/icons/unicons/paypal.png" alt="User" class="rounded">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <small class="text-muted d-block mb-1">Paypal</small>
                    <h6 class="mb-0">Send money</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0">+82.6</h6>
                    <span class="text-muted">USD</span>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="../bootstrap-config/assets/img/icons/unicons/wallet.png" alt="User" class="rounded">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <small class="text-muted d-block mb-1">Wallet</small>
                    <h6 class="mb-0">Mac'D</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0">+270.69</h6>
                    <span class="text-muted">USD</span>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="../bootstrap-config/assets/img/icons/unicons/chart.png" alt="User" class="rounded">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <small class="text-muted d-block mb-1">Transfer</small>
                    <h6 class="mb-0">Refund</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0">+637.91</h6>
                    <span class="text-muted">USD</span>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="../bootstrap-config/assets/img/icons/unicons/cc-success.png" alt="User" class="rounded">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <small class="text-muted d-block mb-1">Credit Card</small>
                    <h6 class="mb-0">Ordered Food</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0">-838.71</h6>
                    <span class="text-muted">USD</span>
                  </div>
                </div>
              </li>
              <li class="d-flex mb-4 pb-1">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="../bootstrap-config/assets/img/icons/unicons/wallet.png" alt="User" class="rounded">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <small class="text-muted d-block mb-1">Wallet</small>
                    <h6 class="mb-0">Starbucks</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0">+203.33</h6>
                    <span class="text-muted">USD</span>
                  </div>
                </div>
              </li>
              <li class="d-flex">
                <div class="avatar flex-shrink-0 me-3">
                  <img src="../bootstrap-config/assets/img/icons/unicons/cc-warning.png" alt="User" class="rounded">
                </div>
                <div class="d-flex w-100 flex-wrap align-items-center justify-content-between gap-2">
                  <div class="me-2">
                    <small class="text-muted d-block mb-1">Mastercard</small>
                    <h6 class="mb-0">Ordered Food</h6>
                  </div>
                  <div class="user-progress d-flex align-items-center gap-1">
                    <h6 class="mb-0">-92.45</h6>
                    <span class="text-muted">USD</span>
                  </div>
                </div>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <!--/ Transactions -->
    </div>
  </div>
</div>
<!-- Content wrapper -->
<?php include "../private/shared/footer.php"; ?>