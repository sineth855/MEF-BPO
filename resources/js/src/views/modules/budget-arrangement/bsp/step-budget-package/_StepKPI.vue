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

          <template slot="thead">
            <vs-th>កូដកម្មវិធី</vs-th>
            <vs-th :rowspan="3">សេចក្ដីពណ៌នា</vs-th>
            <vs-th>កូដសូចនាករ</vs-th>
            <vs-th>គម្រោងថវិកា<br/>ឆ្នាំ២០២៣<br/>(លានរៀល)</vs-th>
            <vs-th>គោលដៅសូចនាករសមិទ្ធកម្ម</vs-th>
            <vs-th></vs-th>
            <vs-th></vs-th>
            <vs-th></vs-th>
            <vs-th></vs-th>
          </template>

          <!-- <template> -->
            
            
            <vs-tr :state="'warning'">
              <vs-td></vs-td>
              <!-- <vs-td></vs-td> -->
              <vs-td></vs-td>
              <vs-td></vs-td>
              <vs-td>ឆ្នាំមុន-២០២១(អនុវត្តរួច)</vs-td>
              <vs-td>ឆ្នាំបច្ចុប្បន្ន-២០២២(កំពុងអនុវត្ត)</vs-td>
              <vs-td>ឆ្នាំគ្រោងថវិកា-២០២៣</vs-td>
              <vs-td>ឆ្នាំគ្រោងថវិកា​២០២៤</vs-td>
              <vs-td>ឆ្នាំគ្រោងថវិកា​២០២៥</vs-td>
              <vs-td></vs-td>
            </vs-tr>

            <vs-tr :state="'warning'">
              <vs-td></vs-td>
              <!-- <vs-td></vs-td> -->
              <vs-td></vs-td>
              <vs-td></vs-td>
              <vs-td></vs-td>
              <vs-td></vs-td>
              <vs-td>គោលដៅ</vs-td>
              <vs-td>មូលហេតុផ្លាស់ប្ដូរ (ធៀបឆ្នាំ២០២២)</vs-td>
              <vs-td></vs-td>
              <vs-td></vs-td>
            </vs-tr>

            <vs-tr :state="'primary'">
                <vs-td></vs-td>
                <vs-td>១.១. អនុកម្មវិធីទី១.១ : ការគ្រប់គ្រងគោលនយោបាយសេដ្ឋកិច្ច ហិរញ្ញវត្ថុ និងគោលនយោបាយតាមវិស័យផ្សេងៗ</vs-td>
                <vs-td></vs-td>
                <vs-td>0.0</vs-td>
                <vs-td></vs-td>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
            </vs-tr>

            <vs-tr>
                <vs-td></vs-td>
                <vs-td>-សូចនាករទី១ : ... </vs-td>
                <vs-td>PI-1011</vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
            </vs-tr>

            <vs-tr>
                <vs-td></vs-td>
                <vs-td>-សូចនាករទី២ : ... </vs-td>
                <vs-td>PI-1011</vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
            </vs-tr>
<!-- 
            <vs-tr :state="'warning'">
                <vs-td></vs-td>
                <vs-td>១.១.១. ចង្កោមសកម្មភាពទី១ : គាំទ្រ សម្របសម្រួល និងគ្រប់គ្រងការងាររដ្ឋបាលរបស់អគ្គនាយកដ្ឋាន</vs-td>
                <vs-td></vs-td>
                <vs-td>0.0</vs-td>
                <vs-td></vs-td>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
            </vs-tr>

            <vs-tr>
                <vs-td></vs-td>
                <vs-td>-សូចនាករទី១ : ... </vs-td>
                <vs-td>PI-1011</vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
            </vs-tr>

            <vs-tr>
                <vs-td></vs-td>
                <vs-td>-សូចនាករទី២ : ... </vs-td>
                <vs-td>PI-1011</vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
                <vs-th></vs-th>
            </vs-tr> -->
          <!-- </template> -->
        </vs-table>
      </div>
    <!-- ###################### -->
</template>