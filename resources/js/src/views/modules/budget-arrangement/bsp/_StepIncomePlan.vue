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

            <template slot="thead">
            <vs-th rowspan="3" class="rotate">ជំពូក</vs-th>
            <vs-th class="rotate">គណនីយ</vs-th>
            <vs-th class="rotate">អនុគណនី</vs-th>
            <vs-th class="th-width-300">ចំណាត់ថ្នាក់ចំណាយ</vs-th>
            <vs-th class="th-width-300">ចំណូលឆ្នាំ២០២១(អនុវត្ត)</vs-th>
            <vs-th class="th-width-300 text-center" colspan="3"><center>ច្បាប់ហិរញ្ញវត្ថុឆ្នាំ២០២២</center></vs-th>
            <vs-th class="th-width-300" colspan="4">ប៉ាន់ស្មានអនុវត្តឆ្នាំ២០២២</vs-th>
            <vs-th class="th-width-300" colspan="4">គម្រោងឆ្នាំ២០២៣</vs-th>
            </template>

            <template>
            <!-- <vs-tr :state="'success'">
                <vs-td colspan="4" >ផ្នែកទី១៖ ពិដានចំណាយចរន្ត ឆ្នាំ២០២៣-២០២៥ សរុបរួមក្រសួង (យោងលេខ ០៣ សរណន ចុះថ្ងៃទី៨ ខែមិថុនា ឆ្នាំ២០២២)</vs-td>
            </vs-tr> -->
            <!-- <vs-tr style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                <vs-td>គោលបំណងគោលនយោបាយទី១</vs-td>
                <vs-td>កម្មវិធីទី១ៈ ការគ្រប់គ្រងវិស័យសេដ្ឋកិច្ច</vs-td>
                <vs-td>ឯកឧត្តម/លោកជំទាវ</vs-td>
                <vs-td></vs-td>
            </vs-tr> -->
            <vs-tr :state="'success'">
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>

                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>

                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td colspan="2">ប៉ាន់​ស្មាន​ប្រចាំ​ឆ្នាំ</vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td colspan="2">សរុប​ការ​គ្រោ​ង​ចំណូល</vs-td>
            </vs-tr>

            <vs-tr :state="'success'">
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td>សរុប​រួមចំណូល​ (ក+ខ)</vs-td>
                
                <vs-td></vs-td>
                <vs-td class="td-width-150">មូលដ្ឋានគិតចំណូល</vs-td>
                <vs-td class="td-width-150">បរិមាណ</vs-td>
                <vs-td class="td-width-150">សរុបឥណទានថវិកា</vs-td>

                <vs-td class="td-width-150">អនុវត្តឆមាសទី១</vs-td>
                <vs-td class="td-width-150">ប៉ាន់ស្មានឆមាសទី២</vs-td>
                <vs-td class="td-width-150">សរុប</vs-td>
                <vs-td class="td-width-150">%ច្ប.២២</vs-td>

                <vs-td class="td-width-150">មូលដ្ឋានគិតចំណូល</vs-td>
                <vs-td class="td-width-150">បរិមាណ</vs-td>
                <vs-td class="td-width-150">សរុប</vs-td>
                <vs-td class="td-width-150">%ច្ប.២២</vs-td>
            </vs-tr>

            <vs-tr :state="'warning'">
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td>ក្នុងនោះចំណូល​ក្នុងប្រទេស</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
            </vs-tr>

            <vs-tr :state="'warning'">
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td>ក. សរុបចំណូល​ចរន្ត (ក្រុមទី១+ក្រុមទី២)</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
            </vs-tr>

            <vs-tr :state="'warning'">
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td>ក. សរុបចំណូល​ចរន្ត (ក្រុមទី១+ក្រុមទី២)</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
            </vs-tr>

            <vs-tr :state="'warning'">
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td>ក. សរុបចំណូល​ចរន្ត (ក្រុមទី១+ក្រុមទី២)</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
            </vs-tr>

            <vs-tr :state="'warning'">
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td>ប្រភេទទី១: ចំណូល​សារពើពន្ធ</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

                <vs-td>0.0</vs-td>
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
                <vs-td>70</vs-td>
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td>ចំណូលសារពើពន្ធក្នុងស្រុក</vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

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
                <vs-td></vs-td>
                <vs-td>7001</vs-td>
                <vs-td></vs-td>
                <vs-td>ពន្ធផ្ទាល់ (ពន្ធលើផលទុន ប្រាក់ចំណូល)</vs-td>
                <vs-td></vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

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
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td>70011</vs-td>
                <vs-td>ពន្ធលើប្រាក់ចំណូល (រូបវន្តបុគ្គល)</vs-td>
                <vs-td></vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

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
                <vs-td></vs-td>
                <vs-td>7002</vs-td>
                <vs-td></vs-td>
                <vs-td>ពន្ធផ្ទាល់ (ពន្ធលើផលទុន ប្រាក់ចំណូល)</vs-td>
                <vs-td></vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

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
                <vs-td></vs-td>
                <vs-td></vs-td>
                <vs-td>70012</vs-td>
                <vs-td>ពន្ធលើប្រាក់ចំណូល (រូបវន្តបុគ្គល)</vs-td>
                <vs-td></vs-td>

                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>
                <vs-td>0.0</vs-td>

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