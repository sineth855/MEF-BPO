<template>
  <vx-card title="Form wizard with validation" code-toggler>
    <div class="mt-5">
      <form-wizard color="rgba(var(--vs-primary), 1)" errorColor="rgba(var(--vs-danger), 1)" :title="null" :subtitle="null" finishButtonText="Submit">
        <!-- Tab 1  -->
        <tab-content title="រៀបចំផែនការយុទ្ធសាស្ត្រថវិកា" class="mb-5" icon="feather icon-home" :before-change="validateStep1">
          <!-- tab 1 content -->
          <vx-card title="ផែនការយុទ្ធសាស្ត្រថវិកា" code-toggler>
              <div class="mt-5">
                  <vs-collapse>
                    <vs-collapse-item>
                      <div slot="header" style="color: #fff; background-color:#28c76f; padding: 10px;">
                        អនុកម្មវិធី អ្នកគ្រប់គ្រង និងអង្គភាពទទួលខុសត្រូវ 
                      </div>
                      
                      <div class="flex justify-between flex-wrap mb-4">
                        <vs-button class="mt-4 mr-2 shadow-lg" type="gradient" color="#7367F0" gradient-color-secondary="#CE9FFC">{{$t("Download")}}</vs-button>
                        <vs-checkbox color="success" v-model="checkBox2">បានត្រួតពិនិត្យ</vs-checkbox>
                        <vs-button class="mt-4" type="border" color="#30c974"><feather-icon icon="PlusIcon" svgClasses="h-4 w-4" /> {{$t("AddNew")}}</vs-button>
                      </div>
                      
                      <div class="flex items-center">
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
                                    តារាង១ៈ អនុកម្មវិធី អ្នកគ្រប់គ្រង និងអង្គភាពទទួលខុសត្រូវ
                                  </span>
                                  <div class="clearfix"></div>
                                  <br/>
                              </center>
                          </div>
                          <div class="clearfix"></div>
                          <vs-table :data="[]">

                            <template slot="thead">
                              <vs-th>ឈ្មោះគោលបំណងគោលនយោបាយ</vs-th>
                              <vs-th>ឈ្មោះកម្មវិធី និងអនុកម្មវិធី</vs-th>
                              <vs-th>អ្នកគ្រប់គ្រង</vs-th>
                              <vs-th>អ្នកទទួលខុសត្រូវ</vs-th>
                            </template>

                            <template>
                              <vs-tr :state="'success'">
                                <vs-td colspan="4" >ផ្នែកទី១៖ ពិដានចំណាយចរន្ត ឆ្នាំ២០២៣-២០២៥ សរុបរួមក្រសួង (យោងលេខ ០៣ សរណន ចុះថ្ងៃទី៨ ខែមិថុនា ឆ្នាំ២០២២)</vs-td>
                              </vs-tr>
                              <vs-tr style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                                <vs-td>គោលបំណងគោលនយោបាយទី១</vs-td>
                                <vs-td>កម្មវិធីទី១ៈ ការគ្រប់គ្រងវិស័យសេដ្ឋកិច្ច</vs-td>
                                <vs-td>ឯកឧត្តម/លោកជំទាវ</vs-td>
                                <vs-td></vs-td>
                              </vs-tr>
                              
                              <vs-tr :state="'warning'">
                                <vs-td></vs-td>
                                <vs-td>១.‌១.អនុកម្មវិធីទី១.១. ការគ្រប់គ្រងគោលនយោបាយសេដ្ឋកិច្ច ហិរញ្ញវត្ថុ និងគោលនយោបាយតាមវិស័យផ្សេងៗ</vs-td>
                                <vs-td>ឯកឧត្តម/លោកជំទាវ</vs-td>
                                <vs-td>អគ្គនាយកដ្ឋានគោលនយោបាយ</vs-td>
                              </vs-tr>

                              <vs-tr>
                                <vs-td></vs-td>
                                <vs-td>- ១.១.‌១.ចង្កោមសកម្មភាពទី១ៈ គាំទ្រសម្របសម្រួល និងគ្រប់គ្រងការងាររដ្ឋបាលរបស់នាយកដ្ឋាន</vs-td>
                                <vs-td>លោក/លោកស្រី</vs-td>
                                <vs-td>លេខាធិការដ្ឋាន</vs-td>
                              </vs-tr>
                              <vs-tr>
                                <vs-td></vs-td>
                                <vs-td>- ១.១.‌១.១.សកម្មភាពទី១ៈ បំពេញមុខងារជាលេខាធិការដ្ឋនា</vs-td>
                                <vs-td>លោក/លោកស្រី</vs-td>
                                <vs-td>លេខាធិការដ្ឋាន</vs-td>
                              </vs-tr>
                            </template>
                          </vs-table>
                        </div>
                        <!-- ###################### -->
                      </div>
                    </vs-collapse-item>

                    <vs-collapse-item>
                      <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">ការកំណត់សូចនាករ និងគោលដៅសូចនាករ នៃអនុកម្មវិធី សង្កោមសកម្មភាព និងសកម្មភាព</div>
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
                                    តារាង១ៈ អនុកម្មវិធី អ្នកគ្រប់គ្រង និងអង្គភាពទទួលខុសត្រូវ
                                  </span>
                                  <div class="clearfix"></div>
                                  <br/>
                              </center>
                          </div>
                          <div class="clearfix"></div>
                          <vs-table :data="[]">

                            <template slot="thead">
                              <vs-th>ឈ្មោះគោលបំណងគោលនយោបាយ</vs-th>
                              <vs-th>ឈ្មោះកម្មវិធី និងអនុកម្មវិធី</vs-th>
                              <vs-th>អ្នកគ្រប់គ្រង</vs-th>
                              <vs-th>អ្នកទទួលខុសត្រូវ</vs-th>
                            </template>

                            <template>
                              <vs-tr :state="'success'">
                                <vs-td colspan="4" >ផ្នែកទី១៖ ពិដានចំណាយចរន្ត ឆ្នាំ២០២៣-២០២៥ សរុបរួមក្រសួង (យោងលេខ ០៣ សរណន ចុះថ្ងៃទី៨ ខែមិថុនា ឆ្នាំ២០២២)</vs-td>
                              </vs-tr>
                              <vs-tr style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                                <vs-td>គោលបំណងគោលនយោបាយទី១</vs-td>
                                <vs-td>កម្មវិធីទី១ៈ ការគ្រប់គ្រងវិស័យសេដ្ឋកិច្ច</vs-td>
                                <vs-td>ឯកឧត្តម/លោកជំទាវ</vs-td>
                                <vs-td></vs-td>
                              </vs-tr>
                              
                              <vs-tr :state="'warning'">
                                <vs-td></vs-td>
                                <vs-td>១.‌១.អនុកម្មវិធីទី១.១. ការគ្រប់គ្រងគោលនយោបាយសេដ្ឋកិច្ច ហិរញ្ញវត្ថុ និងគោលនយោបាយតាមវិស័យផ្សេងៗ</vs-td>
                                <vs-td>ឯកឧត្តម/លោកជំទាវ</vs-td>
                                <vs-td>អគ្គនាយកដ្ឋានគោលនយោបាយ</vs-td>
                              </vs-tr>

                              <vs-tr>
                                <vs-td></vs-td>
                                <vs-td>- ១.១.‌១.ចង្កោមសកម្មភាពទី១ៈ គាំទ្រសម្របសម្រួល និងគ្រប់គ្រងការងាររដ្ឋបាលរបស់នាយកដ្ឋាន</vs-td>
                                <vs-td>លោក/លោកស្រី</vs-td>
                                <vs-td>លេខាធិការដ្ឋាន</vs-td>
                              </vs-tr>
                              <vs-tr>
                                <vs-td></vs-td>
                                <vs-td>- ១.១.‌១.១.សកម្មភាពទី១ៈ បំពេញមុខងារជាលេខាធិការដ្ឋនា</vs-td>
                                <vs-td>លោក/លោកស្រី</vs-td>
                                <vs-td>លេខាធិការដ្ឋាន</vs-td>
                              </vs-tr>
                            </template>
                          </vs-table>
                        </div>
                      <!-- ###################### -->
                    </vs-collapse-item>

                    <vs-collapse-item _disabled>
                      <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">ការគ្រោងចំណូល</div>
                      Data under control
                    </vs-collapse-item>

                    <vs-collapse-item>
                        <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">ការកំណត់តម្រូវការចំណាយសម្រាប់អនុកម្មវិធី</div>
                        Data under control
                    </vs-collapse-item>
                  </vs-collapse>
              </div>

          </vx-card>
        </tab-content>

        <!-- tab 2 content -->
        <tab-content title="រៀបចំកញ្ចប់ថវិកា" class="mb-5" icon="feather icon-briefcase" :before-change="validateStep2">
          <vs-collapse>
              <vs-collapse-item>
                <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">
                  <!-- <vs-alert color="primary" icon="new_releases" active="true" class="mt-5"> -->
                  គម្រោងថវិកាតាមចំណាត់ថ្នាក់សេដ្ឋកិច្ច
                  <!-- </vs-alert> -->
                </div>
                Data under control
              </vs-collapse-item>

              <vs-collapse-item>
                <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">គោលបំណង និងការទទួលខុសត្រូវលើអនុកម្មវិធី សង្កោមសកម្មភាព និងសកម្មភាព</div>
                Data under control
              </vs-collapse-item>

              <vs-collapse-item _disabled>
                <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">វឌ្ឍនភាពសូចនាករ និងគោលដៅសូចនាករនៃកម្មវិធី សង្កោមសកម្មភាព និងសកម្មភាព</div>
                Data under control
              </vs-collapse-item>

              <vs-collapse-item>
                <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">សូចនាករ និងគោលដៅសូចនាករ</div>
                Data under control
              </vs-collapse-item>
            </vs-collapse>
        </tab-content>

        <!-- tab 3 content -->
        <tab-content title="បោះពុម្ភ" class="mb-5" icon="feather icon-image" :before-change="validateStep3">
          <vs-navbar
            text-color="rgba(255,255,255,.6)"
            active-text-color="rgba(255,255,255,1)" 
            :type="type" 
            color="#F4F4F4"
            v-model="activeItem" 
            style="box-shadow: 1px 5px 15px;"
            class="p-2 mb-6">

            <div slot="title">
              <vs-navbar-title>
                <span>ការផ្ទៀងផ្ទាត់ និងធ្វើការបោះពុម្ភ</span>
              </vs-navbar-title>
            </div>

            <vs-navbar-item index="0">
                <a href="#" style="color: #000000;">បោះពុម្ភ</a>
            </vs-navbar-item>
          </vs-navbar>

          <div class="vx-row">
              <!-- Background Color -->
            <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
                <vx-card
                    title="បោះពុម្ភ"
                    title-color="#fff"
                    card-background="primary"
                    content-color="#fff"
                    code-toggler>
                    <center><h5 class="pb-4" style="line-height: 30px;">កម្មវិធី អនុកម្មវិធី អ្នកគ្រប់គ្រង និងអង្គភាពទទួលខុសត្រូវ</h5></center>
                    <p class="mb-3​">
                      <center><vs-button class="mt-4 mr-2 shadow-lg" type="border" color="#ffffff" gradient-color-secondary="#CE9FFC">{{$t("Download")}}</vs-button></center>
                    </p>
                </vx-card>
            </div>
            <!-- Background Color -->
            <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
                <vx-card
                    title="បោះពុម្ភ"
                    title-color="#fff"
                    card-background="danger"
                    content-color="#fff"
                    code-toggler>
                    <center><h5 class="pb-4" style="line-height: 30px;">ការគ្រោងចំណូល/ចំណាយប្រចាំឆ្នាំ សម្រាប់អង្គភាព</h5></center>
                    <p class="mb-3​">
                      <center><vs-button class="mt-4 mr-2 shadow-lg" type="border" color="#ffffff" gradient-color-secondary="#CE9FFC">{{$t("Download")}}</vs-button></center>
                    </p>
                </vx-card>
            </div>

            <!-- Background Color -->
            <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
                <vx-card
                    title="បោះពុម្ភ"
                    title-color="#fff"
                    card-background="warning"
                    content-color="#fff"
                    code-toggler>
                    <center><h5 class="pb-4" style="line-height: 30px;">កំណត់តម្រូវការចំណាយសម្រាប់កម្មវិធី និងអនុកម្មវិធី</h5></center>
                    <p class="mb-3​">
                      <center><vs-button class="mt-4 mr-2 shadow-lg" type="border" color="#ffffff" gradient-color-secondary="#CE9FFC">{{$t("Download")}}</vs-button></center>
                    </p>
                </vx-card>
            </div>

            <!-- Background Color -->
            <div class="vx-col w-full sm:w-1/4 md:w-1/4 lg:w-1/4 xl:w-1/4 mb-base">
              <vx-card
                  title="បោះពុម្ភ"
                  title-color="#fff"
                  card-background="primary"
                  content-color="#fff"
                  code-toggler>
                  <center><h5 class="pb-4" style="line-height: 30px;">ការកំណត់តម្រូវការចំណាយសម្រាប់ក្រសួង-ស្ថាប័ន</h5></center>
                  <p class="mb-3​">
                    <center><vs-button class="mt-4 mr-2 shadow-lg" type="border" color="#ffffff" gradient-color-secondary="#CE9FFC">{{$t("Download")}}</vs-button></center>
                  </p>
              </vx-card>
            </div>

          </div>

          
        </tab-content>

      </form-wizard>
    </div>
  </vx-card>
</template>

<script>
import { FormWizard, TabContent } from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'

// For custom error message
import { Validator } from 'vee-validate';
const dict = {
    custom: {
        first_name: {
            required: 'First name is required',
            alpha: "First name may only contain alphabetic characters"
        },
        last_name: {
            required: 'Last name is required',
            alpha: "Last name may only contain alphabetic characters"
        },
        email: {
            required: 'Email is required',
            email: "Please enter valid email"
        },
        job_title: {
            required: 'Job title name is required',
            alpha: "Job title may only contain alphabetic characters"
        },
        proposal_title: {
            required: 'Proposal title name is required',
            alpha: "Proposal title may only contain alphabetic characters"
        },
        event_name: {
            required: 'Event name is required',
            alpha: "Event name may only contain alphabetic characters"
        },
    }
};

// register custom messages
Validator.localize('en', dict);

export default {
    data() {
        return {
            firstName: "",
            lastName: "",
            email: "",
            city: "new-york",
            proposalTitle: "",
            jobTitle: "",
            textarea: "",
            eventName: "",
            eventLocation: "san-francisco",
            status: "plannning",
            cityOptions: [
                { text: "New York", value: "new-york" },
                { text: "Chicago", value: "chicago" },
                { text: "San Francisco", value: "san-francisco" },
                { text: "Boston", value: "boston" },
            ],
            statusOptions: [
                { text: "Plannning", value: "plannning" },
                { text: "In Progress", value: "in progress" },
                { text: "Finished", value: "finished" },
            ],
            LocationOptions: [
                { text: "New York", value: "new-york" },
                { text: "Chicago", value: "chicago" },
                { text: "San Francisco", value: "san-francisco" },
                { text: "Boston", value: "boston" },
            ],
        }
    },
    methods: {
        validateStep1() {
            return new Promise((resolve, reject) => {
                this.$validator.validateAll('step-1').then(result => {
                    if (result) {
                        resolve(true)
                    } else {
                        reject("correct all values");
                    }
                })
            })
        },
        validateStep2() {
            return new Promise((resolve, reject) => {
                this.$validator.validateAll("step-2").then(result => {
                    if (result) {
                        resolve(true)
                    } else {
                        reject("correct all values");
                    }
                })
            })
        },
        validateStep3() {
            return new Promise((resolve, reject) => {
                this.$validator.validateAll("step-3").then(result => {
                    if (result) {
                        alert("Form submitted!");
                        resolve(true)
                    } else {
                        reject("correct all values");
                    }
                })
            })
        }
    },
    components: {
        FormWizard,
        TabContent
    }
}
</script>
