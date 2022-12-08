<template>
    <div style="overflow: scroll">
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
                    ការគ្រោងចំណូល
                </span>
                <div class="clearfix"></div>
                <br/>
            </center>
        </div>
        <div class="clearfix"></div>
        <vs-table :data="[]">

            <!-- <template slot="thead">
                <vs-th rowspan="3" class="rotate">ជំពូក</vs-th>
                <vs-th class="rotate">គណនីយ</vs-th>
                <vs-th class="rotate">អនុគណនី</vs-th>
                <vs-th class="th-width-300">ចំណាត់ថ្នាក់ចំណាយ</vs-th>
                <vs-th class="th-width-300">ចំណូលឆ្នាំ២០២១(អនុវត្ត)</vs-th>
                <vs-th class="th-width-300 text-center" colspan="3"><center>ច្បាប់ហិរញ្ញវត្ថុឆ្នាំ២០២២</center></vs-th>
                <vs-th class="th-width-300" colspan="4">ប៉ាន់ស្មានអនុវត្តឆ្នាំ២០២២</vs-th>
                <vs-th class="th-width-300" colspan="4">គម្រោងឆ្នាំ២០២៣</vs-th>
            </template> -->

            <template>
            
            <vs-tr>
                <vs-td rowspan="2">ការគ្រោងចំណូល <br/> តាមប្រភេទចំណូល</vs-td>
                <vs-td colspan="2">ច្បាប់ហិរញ្ញវត្ថុឆ្នាំ២០២២</vs-td>
                <vs-td colspan="2">គ្រោងឆ្នាំ២០២៣</vs-td>
                <vs-td colspan="2">គ្រោងឆ្នាំ២០២៤</vs-td>
                <vs-td colspan="2">គ្រោងឆ្នាំ២០២៥</vs-td>
            </vs-tr>

            <vs-tr>
                <vs-td>ថវិការដ្ឋ</vs-td>
                <vs-td>ថវិកាដៃគូអភិវឌ្ឍន៍</vs-td>
                
                <vs-td>ថវិការដ្ឋ</vs-td>
                <vs-td>ថវិកាដៃគូអភិវឌ្ឍន៍</vs-td>

                <vs-td>ថវិការដ្ឋ</vs-td>
                <vs-td>ថវិកាដៃគូអភិវឌ្ឍន៍</vs-td>

                <vs-td>ថវិការដ្ឋ</vs-td>
                <vs-td>ថវិកាដៃគូអភិវឌ្ឍន៍</vs-td>
            </vs-tr>


            <!-- Row Data -->
            <vs-tr :state="'warning'">
                <vs-td><center>សរុបរួម</center></vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
            </vs-tr>

            <!-- Row Data -->
            <vs-tr :state="'danger'">
                <vs-td><center>១.ចំណូលពីប្រភពក្នុងស្រុក</center></vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
            </vs-tr>


<!-- Row Data -->
            <vs-tr>
                <vs-td><center>ចំណូលសារពើពន្ធ</center></vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
            </vs-tr>


<vs-tr>
                <vs-td><center>ចំណូលមិនមែនសារពើពន្ធ</center></vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
            </vs-tr>
            <vs-tr>
                <vs-td><center>ចំណូលមូលធនក្នុងស្រុក (កម្ចីបន្ត)</center></vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
            </vs-tr>

            </template>
        </vs-table>
    </div>
</template>