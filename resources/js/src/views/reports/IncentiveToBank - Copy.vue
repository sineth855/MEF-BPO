<!-- =========================================================================================
    File Name: Invoice.vue
    Description: Invoice Page
    ----------------------------------------------------------------------------------------
    Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
      Author: Pixinvent
    Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
    <div id="invoice-page">

        <div class="flex flex-wrap items-center justify-between">
          <vx-input-group class="mb-base mr-3">
            <vs-input v-model="mailTo" placeholder="Email" />

            <template slot="append">
              <div class="append-text btn-addon">
                <vs-button type="border" @click="mailTo = ''" class="whitespace-no-wrap">Send To Cabinate</vs-button>
              </div>
            </template>
          </vx-input-group>
          <div class="flex items-center">
            <vs-button class="mb-base mr-3" type="border" icon-pack="feather" icon="icon icon-download">Download</vs-button>
            <vs-button class="mb-base mr-3" icon-pack="feather" icon="icon icon-file" @click="printInvoice">Print</vs-button>
          </div>
        </div>

        <vx-card id="invoice-container">
            <div>
                <div class="container">
                   <section>
                        <div class="pull-right italic">
                            ថ្ងៃ​​ <span style="font-family: arial !important">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                            ខែ <span style="font-family: arial !important">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> 
                            ឆ្នាំជូត ទោស័ក
                            ព.ស. ២៥៦៤ <br/> 
                            <span style="font-family: arial !important">&nbsp;&nbsp;&nbsp;</span> 
                            រាជធានីភ្នំពេញ, ថ្ងៃទី  <span style="font-family: arial !important">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>  
                            ខែ  <span style="font-family: arial !important">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> ឆ្នាំ២០២០
                        </div>
                        <div class="clearfix"></div>
                    </section>
                    <center>
                        <span class="font-mef2">
                            សូមគោរពជូន<br/>
                            ធនាគាឯកទេសវីង<br/>
                        </span>
                        <div class="clearfix"></div>
                    </center>
                    <section class="objective">
                        <span class="font-mef2">កម្មវត្ថុ</span> ៖	ការបើកផ្តល់ប្រាក់ឧបត្ថម្ភមុខងារក្រុមការងារកែទម្រង់ការគ្រប់គ្រងហិរញ្ញវត្ថុសាធារណៈ <b>ប្រចាំខែមិថុនា ឆ្នាំ២០២០</b> ជូន ថ្នាក់ដឹកនាំ និងមន្រ្តីរាជការ គ្រប់ក្រសួង -ស្ថាប័ន ដែលមានគណធនាគារឯកទេសវីង។
                    </section>
                    <section class="reference">
                        <span class="font-mef2">យោង</span> ៖  	លិខិតលេខ០២០ /សហវ. ចុះថ្ងៃទី  ២៤ ខែមីនា ឆ្នាំ២០២០  សេចក្តីសម្រេចស្តីពីការធ្វើបច្ចុប្បន្នភាពទទួលស្គាល់សមាសភាពក្រុមការងារកែទម្រង់ការគ្រប់គ្រងហិរញ្ញវត្ថុសាធារណៈ នៅតាមក្រសួង-ស្ថាប័ន សម្រាប់ទទួលប្រាក់ឧបត្ថម្ភមុខងារឆ្នាំ២០២០។
                    </section>
                    <section class="description">
                        <p>
                            <div class="text-indent">
                                សេចក្ដីដូចមានចែងក្នុងកម្មវត្ថុនិងយោងខាងលើ សូម <span class="font-mef2">ធនាគារឯកទេសវីង</span> មេត្តាចាត់ចែងបើកប្រាក់ឧបត្ថម្ភមុខងារ ក្រុមការងារកែទម្រង់ការគ្រប់គ្រងហិរញ្ញវត្ថុសាធារណៈ ប្រចាំខែមិថុនា ឆ្នាំ២០២០ ជូនថ្នាក់ដឹកនាំ   និងមន្រ្តីរាជការ ក្រសួង-ស្ថាប័ន ដែលមានគណនីនៅធនាគារឯកទេសវីង តាមតារាងទូទាត់ ដែលភ្ជាប់មកជាមួយ នៅថវិកាសរុប <b>{{incentiveInfo.total_incentive_in_khmer}} រៀល ({{incentiveInfo.total_incentive_in_word}}រៀលគត់)</b>  ជូនក្រសួង-ស្ថាប័ន <b>ចំនួន០៤</b> ដូចខាងក្រោម៖
                            </div>
                        </p>
                        <ul class="list">
                            <li :data="tr" :key="indextr" v-for="(tr, indextr) in incentiveByEntity">{{tr.no}}. {{tr.entity}} ចំនួនថវិកា {{tr.total_incentive}} រៀល</li>
                        </ul>
                        <p>
                            <div class="text-indent">
                                អាស្រ័យដូចបានជម្រាបជូនខាងលើ សូម <span class="font-mef2">ធនាគារឯកទេសវីង</span> មេត្តាចាត់ចែង បើកជូនតាមសំណើខាងលើឱ្យបានឆាប់រហ័សតាមការគួរ។ 
                            </div>
                        </p>
                        <p>
                            <div class="text-indent">
                                សូម <span class="font-mef2">ធនាគារឯកទេសវីង</span> ទទួលនូវការគោរពរាប់អានដ៏ជ្រាលជ្រៅអំពីខ្ញុំ
                            </div>
                        </p>
                    </section>
                    <section>
                        <div class="pull-right">
                            <center>
                                <span class="font-mef2">
                                    អគ្គលេខាធិការ<br/>
                                    អគ្គលេខាធិការដ្ឋានគណៈកម្មាធិការដឹកនាំ<br/>
                                    ការងារកែទម្រង់ការគ្រប់គ្រងហិរញ្ញវត្ថុសាធារណៈ
                                </span>
                            </center>
                        </div>
                    </section>
                </div>
                <div class="clearfix"></div>
                <div class="container" style="margin-top: 50px">
                    <center>
                        <span class="font-mef2" style="font-size: 10pt">
                            តារាងឈ្មោះថ្នាក់ដឹកនាំំំ និងមន្រ្តីរាជការ ដែលត្រូវទទួលប្រាក់ឧបត្ថម្ភមុខងារក្រុមការងារកែទម្រង់ការគ្រប់គ្រងហិរញ្ញវត្ថុសាធារណៈ របស់ក្រសួង-ស្ថាប័ន<br/>
                            ប្រចាំខែមិថុនា ឆ្នាំ២០២០  តាមរយៈធនាគារឯកទេសវីង <br/>
                        </span>
                        <div class="clearfix"></div>
                    </center>
                    
                    <div>
                        <table class="table" border="1">
                            <tr>
                                <!-- <thead​> -->
                                    <th class="border-dash">ល.រ</th>
                                    <th class="border-dash">គោត្តនាម និង នាម</th>
                                    <th class="border-dash">តួនាទី</th>
                                    <th class="border-dash">ឈ្មោះធនាគារ</th>
                                    <th class="border-dash">លេខគណនី</th>
                                    <th class="border-dash">ប្រាក់ត្រូវបើក</th>
                                <!-- </thead> -->
                            </tr>
                            <tr>
                                <td style="font-size: 8pt;padding: 0;"><i><center>១</center></i></td>
                                <td style="font-size: 8pt;padding: 0;"><i><center>២</center></i></td>
                                <td style="font-size: 8pt;padding: 0;"><i><center>៣</center></i></td>
                                <td style="font-size: 8pt;padding: 0;"><i><center>៤</center></i></td>
                                <td style="font-size: 8pt;padding: 0;"><i><center>៥</center></i></td>
                                <td style="font-size: 8pt;padding: 0;"><i><center>៦</center></i></td>
                            </tr>
                            <tr style="background: rgba(189, 215, 238, 1)">
                                <td colspan="3">
                                    <b>20-ក្រសួងអប់រំ យុវជន និងកីឡា</b>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <center><b>៥,៥៦០,០០០</b></center>
                                </td>
                            </tr>
                            <tr>
                                <td><center>១</center></td>
                                <td>ឯកឧត្តម នូនីម</td>
                                <td><center>ប្រធាន</center></td>
                                <td><center>កាណាឌីយ៉ា ក.អ.</center></td>
                                <td><center>087678909876</center></td>
                                <td><center>៥,៥៦០,០០០</center></td>
                            </tr>
                            <tr>
                                <td><center>២</center></td>
                                <td>ឯកឧត្តម សៅ ឡែន</td>
                                <td><center>អនុប្រធាន</center></td>
                                <td><center>កាណាឌីយ៉ា ក.អ.</center></td>
                                <td><center>087678909876</center></td>
                                <td><center>៥,៥៦០,០០០</center></td>
                            </tr>
                            <tr style="background: rgba(189, 215, 238, 1)">
                                <td colspan="3">
                                    <b>20-ក្រសួងអប់រំ យុវជន និងកីឡា</b>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <center><b>៥,៥៦០,០០០</b></center>
                                </td>
                            </tr>
                            <tr>
                                <td><center>១</center></td>
                                <td>ឯកឧត្តម នូនីម</td>
                                <td><center>ប្រធាន</center></td>
                                <td><center>កាណាឌីយ៉ា ក.អ.</center></td>
                                <td><center>087678909876</center></td>
                                <td><center>៥,៥៦០,០០០</center></td>
                            </tr>
                            <tr>
                                <td><center>២</center></td>
                                <td>ឯកឧត្តម សៅ ឡែន</td>
                                <td><center>អនុប្រធាន</center></td>
                                <td><center>កាណាឌីយ៉ា ក.អ.</center></td>
                                <td><center>087678909876</center></td>
                                <td><center>៥,៥៦០,០០០</center></td>
                            </tr>
                            <tr>
                                <td><center>១</center></td>
                                <td>ឯកឧត្តម នូនីម</td>
                                <td><center>ប្រធាន</center></td>
                                <td><center>កាណាឌីយ៉ា ក.អ.</center></td>
                                <td><center>087678909876</center></td>
                                <td><center>៥,៥៦០,០០០</center></td>
                            </tr>
                            <tr style="background: rgba(189, 215, 238, 1)">
                                <td colspan="3">
                                    <b>20-ក្រសួងអប់រំ យុវជន និងកីឡា</b>
                                </td>
                                <td></td>
                                <td></td>
                                <td>
                                    <center><b>៥,៥៦០,០០០</b></center>
                                </td>
                            </tr>
                            <tr>
                                <td><center>២</center></td>
                                <td>ឯកឧត្តម សៅ ឡែន</td>
                                <td><center>អនុប្រធាន</center></td>
                                <td><center>កាណាឌីយ៉ា ក.អ.</center></td>
                                <td><center>087678909876</center></td>
                                <td><center>៥,៥៦០,០០០</center></td>
                            </tr>
                            <tr>
                                <td><center>១</center></td>
                                <td>ឯកឧត្តម នូនីម</td>
                                <td><center>ប្រធាន</center></td>
                                <td><center>កាណាឌីយ៉ា ក.អ.</center></td>
                                <td><center>087678909876</center></td>
                                <td><center>៥,៥៦០,០០០</center></td>
                            </tr>
                            <tr>
                                <td><center>២</center></td>
                                <td>ឯកឧត្តម សៅ ឡែន</td>
                                <td><center>អនុប្រធាន</center></td>
                                <td><center>កាណាឌីយ៉ា ក.អ.</center></td>
                                <td><center>087678909876</center></td>
                                <td><center>៥,៥៦០,០០០</center></td>
                            </tr>
                            <tr>
                                <td><center>១</center></td>
                                <td>ឯកឧត្តម នូនីម</td>
                                <td><center>ប្រធាន</center></td>
                                <td><center>កាណាឌីយ៉ា ក.អ.</center></td>
                                <td><center>087678909876</center></td>
                                <td><center>៥,៥៦០,០០០</center></td>
                            </tr>
                            <tr>
                                <td><center>២</center></td>
                                <td>ឯកឧត្តម សៅ ឡែន</td>
                                <td><center>អនុប្រធាន</center></td>
                                <td><center>កាណាឌីយ៉ា ក.អ.</center></td>
                                <td><center>087678909876</center></td>
                                <td><center>៥,៥៦០,០០០</center></td>
                            </tr>
                            <tr>
                                <td><center>១</center></td>
                                <td>ឯកឧត្តម នូនីម</td>
                                <td><center>ប្រធាន</center></td>
                                <td><center>កាណាឌីយ៉ា ក.អ.</center></td>
                                <td><center>087678909876</center></td>
                                <td><center>៥,៥៦០,០០០</center></td>
                            </tr>
                            <tr>
                                <td><center>២</center></td>
                                <td>ឯកឧត្តម សៅ ឡែន</td>
                                <td><center>អនុប្រធាន</center></td>
                                <td><center>កាណាឌីយ៉ា ក.អ.</center></td>
                                <td><center>087678909876</center></td>
                                <td><center>៥,៥៦០,០០០</center></td>
                            </tr>
                            <tr>
                                <td><center>១</center></td>
                                <td>ឯកឧត្តម នូនីម</td>
                                <td><center>ប្រធាន</center></td>
                                <td><center>កាណាឌីយ៉ា ក.អ.</center></td>
                                <td><center>087678909876</center></td>
                                <td><center>៥,៥៦០,០០០</center></td>
                            </tr>
                            <tr>
                                <td><center>២</center></td>
                                <td>ឯកឧត្តម សៅ ឡែន</td>
                                <td><center>អនុប្រធាន</center></td>
                                <td><center>កាណាឌីយ៉ា ក.អ.</center></td>
                                <td><center>087678909876</center></td>
                                <td><center>៥,៥៦០,០០០</center></td>
                            </tr>
                            <!-- <tfooter> -->
                            <tr>
                                <td></td>
                                <td colspan="2"><span class="font-mef2">សរុបប្រាក់ឧបត្ថម្ភត្រូវបើកផ្តល់</span></td>
                                <td></td>
                                <td></td>
                                <td><span class="font-mef2">៥៦,៧៨៩,០០០</span></td>
                            </tr>
                            <!-- </tfooter> -->
                        </table>
                    </div>

                    <span style="position: relative;font-size: 9pt;">
                        <br/>
                        <div class="pull-right">
                            <span>
                                <center>
                                    ថ្ងៃអង្គារ ០៧រោច  ខែចេត្រ ឆ្នាំជូត ទោស័ក ឯកស័ក ព.ស ២៥៦៤<br/>
                                    រាជធានីភ្នំពេញ ថ្ងៃទី១៤  ខែមិថុនា ឆ្នាំ២០២០<br/>
                                    <span class="font-mef2">រៀបចំដោយមន្ត្រីជំនាញថវិកា<br/></span>
                                    <span class="font-mef2">លឿង សុវណ្ណឌី</span>
                                </center>
                            </span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pull-left">
                            <span>
                                <center>
                                    បានឃើញ និងពិនិត្យត្រឹមត្រូវ<br/>
                                    សូមគោរពជូន ឯកឧត្តមអគ្គលេខាធិការ <br/>
                                    មេត្តាពិនិត្យ និងសម្រេចដ៏ខ្ពង់ខ្ពស់ <br/>
                                    ថ្ងៃ  ខែ   ឆ្នាំជូត ទោស័ក ទោស័ក ព.ស ២៥៦៤ <br/>
                                    រាជធានីភ្នំពេញ ថ្ងៃទី         ខែ           ឆ្នាំ២០២០ <br/>
                                    <span class="font-mef2">អគ្គលេខាធិការរង</span>
                                </center>
                            </span>
                        </div>
                        <div class="clearfix"></div>
                        <div class="pull-right">
                            <span>
                                <center>
                                    បានឃើញ និងឯកភាព<br/>
                                    ថ្ងៃ                      ខែ                ឆ្នាំជូត ទោស័ក ទោស័ក ព.ស ២៥៦៤<br/>
                                    រាជធានីភ្នំពេញ ថ្ងៃទី        ​​ខែ           ឆ្នាំ២០២០<br/>
                                    <span class="font-mef2">អគ្គលេខាធិការ<br/>
                                    អគ្គលេខាធិការដ្ឋានគណៈកម្មាធិការ<br/>
                                    ដឹកនាំការងារកែទម្រង់ការគ្រប់គ្រងហិរញ្ញវត្ថុសាធារណៈ</span>
                                </center>
                            </span>
                        </div>
                    </span>
                </div>
                <div class="clearfix"></div>
                <div class="container"></div>
                <!-- #################### -->
            </div>
        </vx-card>
    </div>
</template>

<script>
import axios from "@/axios.js"
export default{
    data() {
        return {
            mailTo: "",
            companyDetails: {
                name: 'Microsion Technologies Pvt. Ltd.',
                addressLine1: '9 N. Sherwood Court',
                addressLine2: 'Elyria, OH',
                zipcode: '94203',
                mailId: 'hello@pixinvent.net',
                mobile: '+91 999 999 9999',
            },
            recipientDetails: {
                fullName: 'Peter Stark',
                addressLine1: '8577 West West Drive ',
                addressLine2: 'Holbrook, NY',
                zipcode: '90001',
                mailId: 'peter@mail.com',
                mobile: '+91 988 888 8888',
            },
            invoiceDetails: {
                invoiceNo: '001/2019',
                invoiceDate: 'Mon Dec 10 2018 07:46:00 GMT+0000 (GMT)',
            },
            invoiceData: {
                tasks: [
                    {
                        id: 1,
                        task: 'Website Redesign',
                        hours: 60,
                        rate: 15,
                        amount: 90000,
                    },
                    {
                        id: 2,
                        task: 'Newsletter template design',
                        hours: 20,
                        rate: 12,
                        amount: 24000,
                    },
                ],
                subtotal: 114000,
                discountPercentage: 5,
                discountedAmount: 5700,
                total: 108300,
            },
            incentiveInfo: "",
            incentiveByEntity: ""
        }
    },
    computed: {

    },
    created(){
        this.getIncentiveInfo()
    },
    methods: {
      printInvoice() {
        window.print()
      },
      getIncentiveInfo(){
        let _incentiveId = this.$route.params.id;
        return new Promise((resolve, reject) => {
            axios.get("/api/v1/incentive/" + _incentiveId)
                .then((response) => {
                let _data = response.data
                this.incentiveInfo = _data.data.general
                this.incentiveByEntity = _data.data.incentiveByEntities
            }).catch((error) => { reject(error) })
        })
      }
    },
    components: {},
    mounted() {
      this.$emit("setAppClasses", "invoice-page")
    }
}
</script>

<style lang="scss">
    @import "@sass/vuexy/pages/report.scss";
</style>

<style lang="scss">
@media print {
  .invoice-page {
    font-family: 'Khmer MEF1';
    * {
      visibility: hidden;
    }

    #content-area {
      margin: 0 !important;
    }

    #invoice-container,
    #invoice-container * {
      visibility: visible;
    }
    #invoice-container {
      position: absolute;
      left: 0;
      top: 0;
      box-shadow: none;
    }
  }
    
}
</style>
