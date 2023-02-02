<template>
  <div>
    <vx-card title="" code-toggler>
      <!-- <step-subprogram></step-subprogram> -->
      <!-- <step-income-plan></step-income-plan> -->
      <!-- <step-expense-demand></step-expense-demand> -->
      <div class="mt-5">
        <form-wizard color="rgba(var(--vs-primary), 1)" errorColor="rgba(var(--vs-danger), 1)" :title="null" :subtitle="null" finishButtonText="Submit">
          <!-- tab 2 content -->
          <tab-content title="រៀបចំកញ្ចប់ថវិកា" class="mb-5" icon="feather icon-briefcase" :before-change="validateStep2">
            <vs-collapse>
              <vs-collapse-item>
                <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">
                  <!-- <vs-alert color="primary" icon="new_releases" active="true" class="mt-5"> -->
                  គម្រោងថវិកាចំណាយតាមចំណាត់ថ្នាក់សេដ្ឋកិច្ច
                  <!-- </vs-alert> -->
                </div>
                <step-economic-exppb></step-economic-exppb>
              </vs-collapse-item>

              <vs-collapse-item>
                <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">គោលបំណង
                  និងការទទួលខុសត្រូវលើអនុកម្មវិធី សង្កោមសកម្មភាព និងសកម្មភាព</div>
                <step-objective-sub-program></step-objective-sub-program>
              </vs-collapse-item>

              <vs-collapse-item _disabled>
                <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">វឌ្ឍនភាពសូចនាករ
                  និងគោលដៅសូចនាករនៃកម្មវិធី សង្កោមសកម្មភាព និងសកម្មភាព</div>
                <step-KPI-progress></step-KPI-progress>
              </vs-collapse-item>

              <vs-collapse-item>
                <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">សូចនាករ និងគោលដៅសូចនាករ</div>
                <step-KPI></step-KPI>
              </vs-collapse-item>
            </vs-collapse>
          </tab-content>

          <!-- Tab 1  -->
          <tab-content title="រៀបចំផែនការយុទ្ធសាស្ត្រថវិកា" class="mb-5" icon="feather icon-home" :before-change="validateStep1">
            <!-- tab 1 content -->
            <vx-card title="ផែនការយុទ្ធសាស្ត្រថវិកា" code-toggler>
              <div class="mt-5">
                  <vs-collapse>
                    <vs-collapse-item>
                      <div slot="header" style="color: #fff; background-color:#28c76f; padding: 10px;">អនុកម្មវិធី អ្នកគ្រប់គ្រង និងអង្គភាពទទួលខុសត្រូវ</div>
                      <step-subprogram></step-subprogram>
                    </vs-collapse-item>

                    <vs-collapse-item>
                      <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">ការកំណត់សូចនាករ និងគោលដៅសូចនាករ នៃអនុកម្មវិធី សង្កោមសកម្មភាព និងសកម្មភាព</div>
                      <step-indicator></step-indicator>
                    </vs-collapse-item>

                    <vs-collapse-item _disabled>
                      <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">ការគ្រោងចំណូល</div>
                      <!-- ###################### -->
                      <step-income-plan></step-income-plan>
                      <!-- ###################### -->
                    </vs-collapse-item>

                    <vs-collapse-item>
                        <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">ការកំណត់តម្រូវការចំណាយសម្រាប់អនុកម្មវិធី</div>
                        <!-- ###################### -->
                        <step-expense-demand></step-expense-demand>
                        <!-- ###################### -->
                    </vs-collapse-item>
                  </vs-collapse>
              </div>
            </vx-card>
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
  </div>
</template>

<script>
  import { FormWizard, TabContent } from 'vue-form-wizard'
  import 'vue-form-wizard/dist/vue-form-wizard.min.css'
  import StepExpenseDemand from "./_StepExpenseDemand.vue"
  import StepIncomePlan from "./_StepIncomePlan.vue"
  import StepSubprogram from "./_StepSubprogram.vue"
  import StepIndicator from "./_StepIndicator.vue"

  import StepEconomicExppb from "./step-budget-package/_StepEconomicExppb.vue"
  import StepKPIProgress from "./step-budget-package/_StepKPIProgress.vue"
  import StepObjectiveSubProgram from "./step-budget-package/_StepObjectiveSubProgram.vue"
  import StepKPI from "./step-budget-package/_StepKPI.vue"
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
              type: "",
              activeItem: true,
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
        TabContent,
        StepExpenseDemand,
        StepIncomePlan,
        StepSubprogram,
        StepIndicator,

        StepEconomicExppb,
        StepKPI,
        StepKPIProgress,
        StepObjectiveSubProgram,
      }
  }
</script>

<style>
  th.th-width-300{
    min-width: 260px !important;
  }
  td.td-width-150{
    min-width: 150px !important;
  }
  table tr td, th{
    border: 1px solid #d7d7d7;
  }
  th{
    text-align: center !important;
    /* display: inline; */
  }
  th.rotate{
    transform: rotate(-90deg)
  }
.vs-table--thead th .vs-table-text {
    text-transform: uppercase;
    font-weight: 600;
    text-align: center;
    display: inline !important;
}
</style>