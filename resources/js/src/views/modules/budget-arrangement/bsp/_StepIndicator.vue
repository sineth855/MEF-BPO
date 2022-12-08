<template>
    <!-- ###################### -->
      <div>
        <div class="clearfix"></div>
        <div class="_container-inner">
            <center>
                <span class="font-mef2">
                    ព្រះរាជាណាចក្រកម្ពុជា
                    <br/>
                    ជាតិ សាសនា ព្រះមហាក្សត្រ
                    <br/><center>***</center>
                </span>
            </center>
            <div class="font-mef2" style="float: left;">
              <!-- <img width="120px" src="../../../../assets/images/logo/logo.png"/> -->
              ក្រសួងសេដ្ឋកិច្ច និងហិរញ្ញវត្ថុ<br/>
              អគ្គលេខាធិការដ្ឋានក្រសួងសេដ្ឋកិច្ចនិងហិរញ្ញវត្ថុ<br/>
              នាយកដា្ឋនរដ្ឋបាលនិងហិរញ្ញវត្ថុ<br/>
              ការិយាល័យផែនការថវិកា
            </div><br/><br/>
            <div class="clearfix"></div>
            <center>    
                <!-- <span class="font-mef2" style="color: #0d72a2; font-size: 12pt">
                    បញ្ជីសរុប<br/>
                </span> -->
                <br/>
                <span class="font-mef2" style="color: #0d72a2; font-size: 12pt">
                  ការកំណត់សូចនាករ និងគោលដៅសូចនាករសមិទ្ធកម្ម
                </span>
                <div class="clearfix"></div>
                <br/>
            </center>
        </div>
        <div class="clearfix"></div>
        <vs-table :data="[]" style="overflow: scroll">
          
          <vs-tr>
            <vs-td style="width: 500px" rowspan="3"><center>សេចក្ដីពណ៌នា<br/>
(បន្ថែមជួរដេកមួយសម្រាប់សូចនាករលទ្ធផលនីមួយៗ)</center></vs-td>
            <vs-td style="" rowspan="3"><center>កូដសូចនាករ</center></vs-td>
            <vs-td style="" rowspan="3"><center>គម្រោងថវិកា​ឆ្នាំ២០២៣(លានរៀល)</center></vs-td>
            <vs-td style="" colspan="6"><center>គោលដៅសូចនាករសមិទ្ធកម្ម</center></vs-td>
          </vs-tr>

          <vs-tr>
            <!-- <vs-td></vs-td> -->
            <!-- <vs-td></vs-td> -->
            <!-- <vs-td></vs-td> -->

            <vs-td rowspan="2"><center>ឆ្នាំមុន-២០២១<br/>(អនុវត្តរួច)</center></vs-td>

            <vs-td rowspan="2"><center>ឆ្នាំបច្ចុប្បន្ន-២០២២<br/>(កំពុងអនុវត្ត)</center></vs-td>
            <vs-td colspan="2">ឆ្នាំគ្រោងថវិកា-២០២៣</vs-td>
            <!-- <vs-td></vs-td>   -->

            <vs-td rowspan="2">ឆ្នាំគ្រោងថវិកា​២០២៤</vs-td>
            <vs-td rowspan="2">ឆ្នាំគ្រោងថវិកា២០២៥</vs-td>
          </vs-tr>

          <vs-tr style="width:500px">
            <!-- <vs-td></vs-td> -->
            <!-- <vs-td></vs-td> -->
            <!-- <vs-td></vs-td> -->
            <vs-td>គោលដៅ</vs-td>
            <vs-td style="400px">មូលហេតុផ្លាស់ប្ដូរ (ធៀបឆ្នាំ២០២២)</vs-td>
            <!-- <vs-td></vs-td>
            <vs-td></vs-td> -->


            <!-- <vs-td></vs-td>
            <vs-td></vs-td> -->
          </vs-tr>

            <vs-tr :state="'success'">
                <vs-td>១.១. អនុកម្មវិធីទី១.១ : ការគ្រប់គ្រងគោលនយោបាយសេដ្ឋកិច្ច ហិរញ្ញវត្ថុ និងគោលនយោបាយតាមវិស័យផ្សេងៗ</vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
            </vs-tr>

            <vs-tr>
                <vs-td>-សូចនាករទី១ : ... </vs-td>
                <vs-td>PI-1011</vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
            </vs-tr>

            <vs-tr :state="'warning'">
                <vs-td>១.១.១. ចង្កោមសកម្មភាពទី១ : គាំទ្រ សម្របសម្រួល និងគ្រប់គ្រងការងាររដ្ឋបាលរបស់អគ្គនាយកដ្ឋាន</vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
            </vs-tr>

            <vs-tr>
                <vs-td>-សូចនាករទី១ : ... </vs-td>
                <vs-td>PI-1011</vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
            </vs-tr>

            <vs-tr>
                <vs-td>-សូចនាករទី១ : ... </vs-td>
                <vs-td>PI-1011</vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
            </vs-tr>

            <vs-tr :state="'warning'">
                <vs-td>១.១.១. ចង្កោមសកម្មភាពទី១ : គាំទ្រ សម្របសម្រួល និងគ្រប់គ្រងការងាររដ្ឋបាលរបស់អគ្គនាយកដ្ឋាន</vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
            </vs-tr>

            <vs-tr>
                <vs-td>-សូចនាករទី១ : ... </vs-td>
                <vs-td>PI-1011</vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
            </vs-tr>

            <vs-tr>
                <vs-td>-សូចនាករទី១ : ... </vs-td>
                <vs-td>PI-1011</vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
            </vs-tr>

          <!-- </template> -->
        </vs-table>
      </div>
    <!-- ###################### -->
</template>