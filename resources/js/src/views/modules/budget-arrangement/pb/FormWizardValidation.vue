<!-- =========================================================================================
  File Name: FormWizardValidation.vue
  Description: Form wizard with validation
  ----------------------------------------------------------------------------------------
  Item Name: Vuexy - Vuejs, HTML & Laravel Admin Dashboard Template
  Author: Pixinvent
  Author URL: http://www.themeforest.net/user/pixinvent
========================================================================================== -->


<template>
  <vx-card title="Form wizard with validation" code-toggler>
    <div class="mt-5">
      <form-wizard color="rgba(var(--vs-primary), 1)" errorColor="rgba(var(--vs-danger), 1)" :title="null" :subtitle="null" finishButtonText="Submit">
        <tab-content title="រៀបចំគម្រោងថវិកាប្រចាំឆ្នាំ" class="mb-5" icon="feather icon-home" :before-change="validateStep1">

          <vx-card title="គម្រោងថវិកាប្រចាំឆ្នាំ" code-toggler>


        <div class="mt-5">

            <vs-collapse>
              <vs-collapse-item>
                <div slot="header" style="color: #fff; background-color:#28c76f; padding: 10px;">
                  <!-- <vs-alert color="primary" icon="new_releases" active="true" class="mt-5"> -->
                  គម្រោងចំណូលថវិកាតាមចំណាត់ថ្នាក់សេដ្ឋកិច្ច(PB Revenue)
                  <!-- </vs-alert> -->
                </div>
                Data Under Controll
              </vs-collapse-item>

              <vs-collapse-item _disabled>
                <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">គម្រោងចំណាយថវិកាតាមចំណាត់ថ្នាក់សេដ្ឋកិច្ច(PB Expense)</div>
                Data Under Controll
              </vs-collapse-item>

              <!-- <vs-collapse-item>
                  <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">តារាងសម្រង់ព័ត៌មានបច្ចុប្បន្នភាពរបស់មន្ត្រីរាជការ និងមន្ត្រីជាប់កិច្ចសន្យា</div>
                  Data Under Controll
              </vs-collapse-item> -->

              <vs-collapse-item>
                <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">តារាងគណនាគម្រោងចំណាយបន្ទុកបុគ្គលិក</div>
                Data Under Controll
              </vs-collapse-item>

              <vs-collapse-item>
                <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">សូចនាករ និងគោលដៅសូចនាករ</div>
                Data Under Controll
                <br><br>
                Data Under Controll
                <br><br>
                Data Under Controll
              </vs-collapse-item>

              <vs-collapse-item>
                <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">ចំណាយមិនប្រចាំ</div>
                Data Under Controll
                <br><br>
                Data Under Controll
                <br><br>
                Data Under Controll
              </vs-collapse-item>


            </vs-collapse>
        </div>

    </vx-card>
        </tab-content>

        <!-- tab 2 content -->
        <tab-content title="ផ្ទៀងផ្ទាត់" class="mb-5" icon="feather icon-briefcase" :before-change="validateStep2">
          <vs-collapse>
              <vs-collapse-item>
                <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;" color="primary">
                  <!-- <vs-alert color="primary" icon="new_releases" active="true" class="mt-5"> -->
                  គម្រោងថវិកាតាមចំណាត់ថ្នាក់សេដ្ឋកិច្ច
                  <!-- </vs-alert> -->
                </div>

                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque rhoncus eros tortor, non fringilla lectus cursus et. Fusce vel nisi ante. Aliquam sit amet lectus pharetra, luctus mi sed, aliquet felis. Mauris a tortor viverra, ornare tellus in, consectetur leo.
                <br><br>
                Etiam nec nunc nec nisl luctus tincidunt efficitur vitae elit. Vestibulum iaculis nibh commodo neque ultrices lobortis. Cras magna massa, pretium vitae mattis varius, pharetra nec massa. Aliquam ac ex enim. Quisque consequat dui libero, vel blandit lorem porttitor sit amet. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Nullam sed lobortis nisl, quis eleifend metus.
              </vs-collapse-item>

              <vs-collapse-item>
                <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">គោលបំណង និងការទទួលខុសត្រូវលើអនុកម្មវិធី សង្កោមសកម្មភាព និងសកម្មភាព</div>
                Nunc auctor et leo vitae suscipit. Nullam aliquet purus scelerisque enim hendrerit tristique. Maecenas tincidunt dui arcu, a aliquet nisl venenatis vitae. Praesent mauris ligula, porta at maximus ac, rutrum vitae sapien. Donec a sapien id erat dapibus dignissim sodales in est. Donec gravida dapibus sapien at sollicitudin. Maecenas iaculis quam ex,
                <br><br>
                eu aliquam erat sagittis eget. Suspendisse mollis felis nec ipsum vehicula, at posuere libero viverra. Nam hendrerit dapibus eleifend. Aliquam elit nulla, tincidunt pellentesque enim mollis, consectetur placerat enim. Integer condimentum tristique ante et ullamcorper. Mauris placerat pretium ex. Nam aliquam sed tortor sit amet
                <br><br>
                efficitur. Mauris quis faucibus nulla. Pellentesque egestas non ipsum vel maximus.
              </vs-collapse-item>

              <vs-collapse-item _disabled>
                <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">វឌ្ឍនភាពសូចនាករ និងគោលដៅសូចនាករនៃកម្មវិធី សង្កោមសកម្មភាព និងសកម្មភាព</div>
                Suspendisse aliquet condimentum diam, sed aliquam nisl dapibus et. Aliquam euismod ullamcorper dolor eu
              </vs-collapse-item>

              <vs-collapse-item>
                  <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">សូចនាករ និងគោលដៅសូចនាករ</div>
                  Suspendisse aliquet condimentum diam, sed aliquam nisl dapibus et. Aliquam euismod ullamcorper dolor eu imperdiet. Nullam eget odio at magna gravida suscipit sed vestibulum odio. Maecenas porta elit vel lectus molestie, eget aliquam enim feugiat. Vivamus nec faucibus nisl. Nunc venenatis tempus finibus.
              </vs-collapse-item>
            </vs-collapse>
        </tab-content>

      </form-wizard>
    </div>

    <template slot="codeContainer">
&lt;template&gt;
  &lt;form-wizard color=&quot;rgba(var(--vs-primary), 1)&quot; errorColor=&quot;rgba(var(--vs-danger), 1)&quot; :title=&quot;null&quot; :subtitle=&quot;null&quot; finishButtonText=&quot;Submit&quot;&gt;
    &lt;tab-content title=&quot;Step 1&quot; class=&quot;mb-5&quot; icon=&quot;feather icon-home&quot; :before-change=&quot;validateStep1&quot;&gt;

      &lt;!-- tab 1 content --&gt;
      &lt;form data-vv-scope=&quot;step-1&quot;&gt;
      &lt;div class=&quot;vx-row&quot;&gt;
        &lt;div class=&quot;vx-col md:w-1/2 w-full mt-5&quot;&gt;
          &lt;vs-input label=&quot;First Name&quot; v-model=&quot;firstName&quot; class=&quot;w-full&quot; name=&quot;first_name&quot; v-validate=&quot;'required|alpha'&quot; /&gt;
          &lt;span class=&quot;text-danger&quot;&gt;{{ errors.first('step-1.first_name') }}&lt;/span&gt;
        &lt;/div&gt;
        &lt;div class=&quot;vx-col md:w-1/2 w-full mt-5&quot;&gt;
          &lt;vs-input label=&quot;Last Name&quot;  v-model=&quot;lastName&quot; class=&quot;w-full&quot; name=&quot;last_name&quot; v-validate=&quot;'required|alpha'&quot; /&gt;
          &lt;span class=&quot;text-danger&quot;&gt;{{ errors.first('step-1.last_name') }}&lt;/span&gt;
        &lt;/div&gt;
        &lt;div class=&quot;vx-col md:w-1/2 w-full mt-5&quot;&gt;
          &lt;vs-input type=&quot;email&quot; label=&quot;Email&quot;  v-model=&quot;email&quot; class=&quot;w-full&quot; name=&quot;email&quot; v-validate=&quot;'required|email'&quot; /&gt;
          &lt;span class=&quot;text-danger&quot;&gt;{{ errors.first('step-1.email') }}&lt;/span&gt;
        &lt;/div&gt;
        &lt;div class=&quot;vx-col md:w-1/2 w-full mt-5&quot;&gt;
          &lt;vs-select v-model=&quot;city&quot; class=&quot;w-full select-large&quot; label=&quot;City&quot;&gt;
            &lt;vs-select-item :key=&quot;index&quot; :value=&quot;item.value&quot; :text=&quot;item.text&quot; v-for=&quot;(item,index) in cityOptions&quot; class=&quot;w-full&quot; /&gt;
          &lt;/vs-select&gt;
        &lt;/div&gt;
      &lt;/div&gt;
      &lt;/form&gt;
    &lt;/tab-content&gt;

    &lt;!-- tab 2 content --&gt;
    &lt;tab-content title=&quot;Step 2&quot; class=&quot;mb-5&quot; icon=&quot;feather icon-briefcase&quot; :before-change=&quot;validateStep2&quot;&gt;
      &lt;form data-vv-scope=&quot;step-2&quot;&gt;
      &lt;div class=&quot;vx-row&quot;&gt;
        &lt;div class=&quot;vx-col md:w-1/2 w-full&quot;&gt;
          &lt;vs-input label=&quot;Proposal Title&quot; v-model=&quot;proposalTitle&quot; class=&quot;w-full mt-4&quot; name=&quot;proposal_title&quot; v-validate=&quot;'required|alpha_spaces'&quot; /&gt;
          &lt;span class=&quot;text-danger&quot;&gt;{{ errors.first('step-2.proposal_title') }}&lt;/span&gt;

          &lt;vs-input label=&quot;Job Title&quot;  v-model=&quot;jobTitle&quot; class=&quot;w-full mt-4&quot; name=&quot;job_title&quot; v-validate=&quot;'required|alpha_spaces'&quot; /&gt;
          &lt;span class=&quot;text-danger&quot;&gt;{{ errors.first('step-2.job_title') }}&lt;/span&gt;
        &lt;/div&gt;
        &lt;div class=&quot;vx-col md:w-1/2 w-full&quot;&gt;
          &lt;vs-textarea v-model=&quot;textarea&quot; label=&quot;Short discription&quot; class=&quot;md:mt-10 mt-6 mb-0&quot; rows=&quot;3&quot; /&gt;
        &lt;/div&gt;
      &lt;/div&gt;
      &lt;/form&gt;
    &lt;/tab-content&gt;

    &lt;!-- tab 3 content --&gt;
    &lt;tab-content title=&quot;Step 3&quot; class=&quot;mb-5&quot; icon=&quot;feather icon-image&quot; :before-change=&quot;validateStep3&quot;&gt;
      &lt;form data-vv-scope=&quot;step-3&quot;&gt;
      &lt;div class=&quot;vx-row&quot;&gt;
        &lt;div class=&quot;vx-col md:w-1/2 w-full&quot;&gt;
          &lt;vs-input label=&quot;Event Name&quot; v-model=&quot;eventName&quot; class=&quot;w-full mt-5&quot; name=&quot;event_name&quot; v-validate=&quot;'required|alpha_spaces'&quot; /&gt;
          &lt;span class=&quot;text-danger&quot;&gt;{{ errors.first('step-3.event_name') }}&lt;/span&gt;
        &lt;/div&gt;
        &lt;div class=&quot;vx-col md:w-1/2 w-full&quot;&gt;
          &lt;vs-select v-model=&quot;city&quot; class=&quot;w-full select-large mt-5&quot; label=&quot;Event Location&quot;&gt;
            &lt;vs-select-item :key=&quot;index&quot; :value=&quot;item.value&quot; :text=&quot;item.text&quot; v-for=&quot;(item,index) in cityOptions&quot; class=&quot;w-full&quot; /&gt;
          &lt;/vs-select&gt;
        &lt;/div&gt;
        &lt;div class=&quot;vx-col md:w-1/2 w-full mt-5&quot;&gt;
          &lt;vs-select v-model=&quot;status&quot; class=&quot;w-full select-large&quot; label=&quot;Event Status&quot;&gt;
            &lt;vs-select-item :key=&quot;index&quot; :value=&quot;item.value&quot; :text=&quot;item.text&quot; v-for=&quot;(item,index) in statusOptions&quot; class=&quot;w-full&quot; /&gt;
          &lt;/vs-select&gt;
        &lt;/div&gt;
        &lt;div class=&quot;vx-col md:w-1/2 w-full md:mt-8&quot;&gt;
          &lt;div class=&quot;demo-alignment&quot;&gt;
            &lt;span&gt;Requirements:&lt;/span&gt;
            &lt;div class=&quot;flex&quot;&gt;
              &lt;vs-checkbox&gt;Staffing&lt;/vs-checkbox&gt;
              &lt;vs-checkbox&gt;Catering&lt;/vs-checkbox&gt;
            &lt;/div&gt;
          &lt;/div&gt;
        &lt;/div&gt;
      &lt;/div&gt;
      &lt;/form&gt;
    &lt;/tab-content&gt;
  &lt;/form-wizard&gt;
&lt;/template&gt;

&lt;script&gt;
import { FormWizard, TabContent } from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'

// For custom error message
import { Validator } from 'vee-validate';
const dict = {
  custom: {
    first_name: {
      required: 'First name is required',
      alpha: &quot;First name may only contain alphabetic characters&quot;
    },
    last_name: {
      required: 'Last name is required',
      alpha: &quot;Last name may only contain alphabetic characters&quot;
    },
    email: {
      required: 'Email is required',
      email: &quot;Please enter valid email&quot;
    },
    job_title: {
      required: 'Job title name is required',
      alpha: &quot;Job title may only contain alphabetic characters&quot;
    },
    proposal_title: {
      required: 'Proposal title name is required',
      alpha: &quot;Proposal title may only contain alphabetic characters&quot;
    },
    event_name: {
      required: 'Event name is required',
      alpha: &quot;Event name may only contain alphabetic characters&quot;
    },
  }
};

// register custom messages
Validator.localize('en', dict);

export default {
  data() {
    return {
      firstName: &quot;&quot;,
      lastName: &quot;&quot;,
      email: &quot;&quot;,
      city: &quot;new-york&quot;,
      proposalTitle: &quot;&quot;,
      jobTitle: &quot;&quot;,
      textarea: &quot;&quot;,
      eventName: &quot;&quot;,
      eventLocation: &quot;san-francisco&quot;,
      status: &quot;plannning&quot;,
      cityOptions: [
        { text: &quot;New York&quot;, value: &quot;new-york&quot; },
        { text: &quot;Chicago&quot;, value: &quot;chicago&quot; },
        { text: &quot;San Francisco&quot;, value: &quot;san-francisco&quot; },
        { text: &quot;Boston&quot;, value: &quot;boston&quot; },
      ],
      statusOptions: [
        { text: &quot;Plannning&quot;, value: &quot;plannning&quot; },
        { text: &quot;In Progress&quot;, value: &quot;in progress&quot; },
        { text: &quot;Finished&quot;, value: &quot;finished&quot; },
      ],
      LocationOptions: [
        { text: &quot;New York&quot;, value: &quot;new-york&quot; },
        { text: &quot;Chicago&quot;, value: &quot;chicago&quot; },
        { text: &quot;San Francisco&quot;, value: &quot;san-francisco&quot; },
        { text: &quot;Boston&quot;, value: &quot;boston&quot; },
      ],
    }
  },
  methods: {
    validateStep1() {
      return new Promise((resolve, reject) =&gt; {
        this.$validator.validateAll('step-1').then(result =&gt; {
          if (result) {
            resolve(true)
          } else {
            reject(&quot;correct all values&quot;);
          }
        })
      })
    },
    validateStep2() {
      return new Promise((resolve, reject) =&gt; {
        this.$validator.validateAll(&quot;step-2&quot;).then(result =&gt; {
          if (result) {
            resolve(true)
          } else {
            reject(&quot;correct all values&quot;);
          }
        })
      })
    },
    validateStep3() {
      return new Promise((resolve, reject) =&gt; {
        this.$validator.validateAll(&quot;step-3&quot;).then(result =&gt; {
          if (result) {
            alert(&quot;Form submitted!&quot;);
            resolve(true)
          } else {
            reject(&quot;correct all values&quot;);
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
&lt;/script&gt;
    </template>
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
