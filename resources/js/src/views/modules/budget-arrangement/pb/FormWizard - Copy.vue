<template>
    <vx-card title="" code-toggler>
        <step-costing></step-costing>
        <div class="mt-5">
            <form-wizard color="rgba(var(--vs-primary), 1)" errorColor="rgba(var(--vs-danger), 1)" :title="null"
                :subtitle="null" finishButtonText="Submit">
                <tab-content :title="$t('pb_step_prepare_annual_budget')" class="mb-5" icon="feather icon-home"
                    :before-change="validateStep1">

                    <vx-card :title="$t('pb_annual_budget_paln')" code-toggler>
                        <div class="mt-5">

                            <vs-collapse>
                                <vs-collapse-item>
                                    <div slot="header" style="color: #fff; background-color:#28c76f; padding: 10px;">
                                        {{ $t("pb_heading_pb_revenue") }}
                                    </div>
                                    <step-revenue></step-revenue>
                                </vs-collapse-item>

                                <vs-collapse-item _disabled>
                                    <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">
                                        {{ $t("pb_heading_pb_expense") }}
                                        <!-- គម្រោងចំណាយថវិកាតាមចំណាត់ថ្នាក់សេដ្ឋកិច្ច(PB Expense) -->
                                    </div>
                                    <!-- <step-expense></step-expense> -->
                                </vs-collapse-item>

                                <vs-collapse-item>
                                    <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">
                                        {{ $t("pb_heading_staff_expense") }}
                                        <!-- តារាងគណនាគម្រោងចំណាយបន្ទុកបុគ្គលិក -->
                                    </div>
                                    <!-- <step-staff-costing></step-staff-costing> -->
                                </vs-collapse-item>

                                <vs-collapse-item>
                                    <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">
                                        {{ $t("pb_heading_target_indicator") }}
                                        <!-- សូចនាករ និងគោលដៅសូចនាករ -->
                                    </div>
                                    <!-- <step-indicator></step-indicator> -->
                                </vs-collapse-item>

                                <vs-collapse-item>
                                    <div slot="header" style="color: #fff; background-color:#C0C9C4; padding: 10px;">
                                        {{ $t("pb_heading_costing") }}
                                        <!-- សូចនាករ និងគោលដៅសូចនាករ -->
                                    </div>
                                    <step-costing></step-costing>
                                </vs-collapse-item>

                            </vs-collapse>
                        </div>
                    </vx-card>
                </tab-content>

                <!-- tab 2 content -->
                <tab-content :title="$t('pb_verify')" class="mb-5" icon="feather icon-briefcase"
                    :before-change="validateStep2">
                    <center>
                        <h2>Page is under construction</h2>
                    </center>
                </tab-content>

            </form-wizard>
        </div>

    </vx-card>
</template>

<script>
import { FormWizard, TabContent } from 'vue-form-wizard'
import 'vue-form-wizard/dist/vue-form-wizard.min.css'
import StepIndicator from "./_StepIndicator.vue"
import StepCosting from "./_StepCosting.vue"
import StepStaffCosting from "./_StepStaffCosting.vue"
import StepRevenue from "./_StepRevenue.vue"
import StepExpense from "./_StepExpense.vue"

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
        TabContent,
        StepIndicator,
        StepCosting,
        StepStaffCosting,
        StepRevenue,
        StepExpense
    }
}
</script>
