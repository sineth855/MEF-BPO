<template>
    <!-- Here is ceiling entity -->
    <!-- Form Input Text -->
    <vs-popup fullscreen classContent="popup-example" title="ទម្រង់បង្កើត Form" :active.sync="showModalForm">
        <div class="vx-row">

            <div class="vx-col lg:w-1/3 w-full mt-4">
                <label class="mb-2">{{ 'Program' }}</label>
                <vs-input size="small" v-model="program_id" class="w-full" />
            </div>

            <div class="vx-col lg:w-1/3 w-full mt-4">
                <label class="mb-2">{{ 'Sub Program' }}</label>
                <vs-input size="small" v-model="sub_program_id" class="w-full" />
            </div>

            <div class="vx-col lg:w-1/3 w-full mt-4">
                <label class="mb-2">{{ 'Entity' }}</label>
                <vs-input size="small" v-model="entity_id" class="w-full" />
            </div>

        </div>

        <div class="vx-row">
            <vs-tabs position="top" class="tabs-shadow-none" id="profile-tabs" :key="isSmallerScreen">
                <vs-tab icon-pack="feather" icon="icon-edit" :label="!isSmallerScreen ? 'បន្ទុកបុគ្គលិក' : ''">
                    <div class="tab-general md:ml-4 md:mt-0 mt-4 ml-0">
                        <div class="vx-row">
                            <div class="vx-col lg:w-1/3 w-full mt-4">
                                <label class="mb-2">{{ 'ច្បាប់ឆ្នាំ N' }}</label>
                                <vs-input size="small" class="w-full" />
                            </div>

                            <div class="vx-col lg:w-1/3 w-full mt-4">
                                <label class="mb-2">{{ 'ចំណាយប្រចាំ' }}</label>
                                <vs-input size="small" class="w-full" />
                            </div>

                            <div class="vx-col lg:w-1/3 w-full mt-4">
                                <label class="mb-2">{{ 'ចំណាយមិនប្រចាំ' }}</label>
                                <vs-input size="small" class="w-full" />
                            </div>
                        </div>

                        <!-- Form Grid -->
                        <div class="mt-4 vx-col lg:w-1/1 w-full">
                            <!-- <vs-alert icon="warning" active="true" color="primary" class="mt-5"> -->
                            <div style="background-color:#253358; color: #ffffff; padding: 5px;">
                                <span>{{ "ពិដានចំណាយចរន្ត" }}</span>
                            </div>

                            <!-- row -->
                            <div class="vx-row">
                                <div class="vx-col lg:w-1/3 w-full mt-4">
                                    <label class="mb-2">{{ 'ឆ្នាំ ២០២៣' }}</label>
                                    <vs-input size="small" class="w-full" />
                                </div>

                                <div class="vx-col lg:w-1/3 w-full mt-4">
                                    <label class="mb-2">{{ 'ឆ្នាំ ២០២៤' }}</label>
                                    <vs-input size="small" class="w-full" />
                                </div>

                                <div class="vx-col lg:w-1/3 w-full mt-4">
                                    <label class="mb-2">{{ 'ឆ្នាំ ២០២៥' }}</label>
                                    <vs-input size="small" class="w-full" />
                                </div>
                            </div>

                        </div>

                        <!-- Form Grid -->
                        <div class="mt-4 vx-col lg:w-1/1 w-full">
                            <!-- <vs-alert icon="warning" active="true" color="primary" class="mt-5"> -->
                            <div style="background-color:#253358; color: #ffffff; padding: 5px;">
                                <span>{{ "អាត្រាកើន/ថយ" }}</span>
                            </div>

                            <!-- row -->
                            <div class="vx-row">
                                <div class="vx-col lg:w-1/3 w-full mt-4">
                                    <label class="mb-2">{{ 'អាត្រាឆ្នាំ ២០២៣' }}</label>
                                    <vs-input size="small" class="w-full" />
                                </div>

                                <div class="vx-col lg:w-1/3 w-full mt-4">
                                    <label class="mb-2">{{ 'អាត្រាឆ្នាំ ២០២៤' }}</label>
                                    <vs-input size="small" class="w-full" />
                                </div>

                                <div class="vx-col lg:w-1/3 w-full mt-4">
                                    <label class="mb-2">{{ 'អាត្រាឆ្នាំ ២០២៥' }}</label>
                                    <vs-input size="small" class="w-full" />
                                </div>
                            </div>

                        </div>
                    </div>
                </vs-tab>

                <vs-tab icon-pack="feather" icon="icon-settings" :label="!isSmallerScreen ? 'ក្រៅបន្ទុកបុគ្គលិក' : ''">
                    <div class="tab-general md:ml-4 md:mt-0 mt-4 ml-0">
                        <div class="vx-row">
                            <div class="vx-col lg:w-1/3 w-full mt-4">
                                <label class="mb-2">{{ 'ច្បាប់ឆ្នាំ N' }}</label>
                                <vs-input size="small" class="w-full" />
                            </div>

                            <div class="vx-col lg:w-1/3 w-full mt-4">
                                <label class="mb-2">{{ 'ចំណាយប្រចាំ' }}</label>
                                <vs-input size="small" class="w-full" />
                            </div>

                            <div class="vx-col lg:w-1/3 w-full mt-4">
                                <label class="mb-2">{{ 'ចំណាយមិនប្រចាំ' }}</label>
                                <vs-input size="small" class="w-full" />
                            </div>
                        </div>

                        <!-- Form Grid -->
                        <div class="mt-4 vx-col lg:w-1/1 w-full">
                            <!-- <vs-alert icon="warning" active="true" color="primary" class="mt-5"> -->
                            <div style="background-color:#253358; color: #ffffff; padding: 5px;">
                                <span>{{ "ពិដានចំណាយចរន្ត" }}</span>
                            </div>

                            <!-- row -->
                            <div class="vx-row">
                                <div class="vx-col lg:w-1/3 w-full mt-4">
                                    <label class="mb-2">{{ 'ឆ្នាំ ២០២៣' }}</label>
                                    <vs-input size="small" class="w-full" />
                                </div>

                                <div class="vx-col lg:w-1/3 w-full mt-4">
                                    <label class="mb-2">{{ 'ឆ្នាំ ២០២៤' }}</label>
                                    <vs-input size="small" class="w-full" />
                                </div>

                                <div class="vx-col lg:w-1/3 w-full mt-4">
                                    <label class="mb-2">{{ 'ឆ្នាំ ២០២៥' }}</label>
                                    <vs-input size="small" class="w-full" />
                                </div>
                            </div>

                        </div>

                        <!-- Form Grid -->
                        <div class="mt-4 vx-col lg:w-1/1 w-full">
                            <!-- <vs-alert icon="warning" active="true" color="primary" class="mt-5"> -->
                            <div style="background-color:#253358; color: #ffffff; padding: 5px;">
                                <span>{{ "អាត្រាកើន/ថយ" }}</span>
                            </div>

                            <!-- row -->
                            <div class="vx-row">
                                <div class="vx-col lg:w-1/3 w-full mt-4">
                                    <label class="mb-2">{{ 'អាត្រាឆ្នាំ ២០២៣' }}</label>
                                    <vs-input size="small" class="w-full" />
                                </div>

                                <div class="vx-col lg:w-1/3 w-full mt-4">
                                    <label class="mb-2">{{ 'អាត្រាឆ្នាំ ២០២៤' }}</label>
                                    <vs-input size="small" class="w-full" />
                                </div>

                                <div class="vx-col lg:w-1/3 w-full mt-4">
                                    <label class="mb-2">{{ 'អាត្រាឆ្នាំ ២០២៥' }}</label>
                                    <vs-input size="small" class="w-full" />
                                </div>
                            </div>

                        </div>
                    </div>
                </vs-tab>
            </vs-tabs>

        </div>
        <span class="pull-right">
            <vs-button type="filled" @click.prevent="submitForm" class="mt-5 block">{{ $t("btn_save") }}</vs-button>
        </span>
    </vs-popup>
</template>
<script>
import axios from "@/axios.js"
import DFormInput from '@/views/form-builder/form-control/DFormInput.vue'
import vSelect from 'vue-select'
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
export default {
    data() {
        return {
            date: null,
            showModalForm: false
        }
    },
    methods: {
        showNewForm() {
            this.showModalForm = true;
        },
        submitForm() {
            this.dataFields = [];
            let _formAttribute = this.formAttributes;
            this.formAttributes.forEach(_formAttribute => {
                let _d = {
                    [_formAttribute["name"]]: this.form.attribute[_formAttribute["name"]]
                }
                this.dataFields.push(_d);
            });
            console.log("Here is form data===>", this.dataFields);
            // return false;
            this.$validator.validateAll().then(result => {
                if (result) {
                    let _data = this.dataFields;
                    // this.$vs.loading();
                    if (this.dataInfo.id) {
                        // alert("Edit");
                        let _id = this.dataInfo.id;
                        // this.$vs.loading.close();
                        return new Promise((resolve, reject) => {
                            axios.put(this.api + '/' + _id, _data)
                                .then((response) => {
                                    this.$vs.notify({
                                        title: 'Message',
                                        text: response.data.message,
                                        iconPack: 'feather',
                                        icon: 'icon-check-circle',
                                        color: 'primary',
                                        position: 'top-right'
                                    })
                                    this.$emit('clickForm');
                                    // this.$router.push('/account/expense').catch(() => { })
                                }).catch((error) => {
                                    reject(error)
                                    this.$vs.notify({
                                        title: 'Message',
                                        text: "មិនអាចដំណើរកាបានទេ,​ សូមត្រួតពិនិត្យពត៌មានឡើងវិញ។",
                                        iconPack: 'feather',
                                        icon: 'icon-check-circle',
                                        color: 'danger',
                                        position: 'top-right'
                                    })
                                    this.$vs.loading.close();
                                })
                        })
                    } else {
                        return new Promise((resolve, reject) => {
                            axios.post(this.api, _data)
                                .then((response) => {
                                    this.$vs.notify({
                                        title: 'Message',
                                        text: response.data.message,
                                        iconPack: 'feather',
                                        icon: 'icon-check-circle',
                                        color: 'primary',
                                        position: 'top-right'
                                    })
                                    // this.$emit('clickForm');
                                    // this.$router.push('/account/expense').catch(() => { })
                                }).catch((error) => {
                                    reject(error)
                                    this.$vs.notify({
                                        title: 'Message',
                                        text: "មិនអាចដំណើរកាបានទេ,​ សូមត្រួតពិនិត្យពត៌មានឡើងវិញ។",
                                        iconPack: 'feather',
                                        icon: 'icon-check-circle',
                                        color: 'danger',
                                        position: 'top-right'
                                    })
                                    this.$vs.loading.close();
                                })
                        })
                    }

                }
                this.$vs.loading.close();
            })
        }
    },
    computed: {
        isSmallerScreen() {
            return this.$store.state.windowWidth < 768
        }
    }
}
</script>