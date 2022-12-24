<template>
    <div>
        <div class="vx-row">
            <!-- {{dataInfo | json}} -->
            <div :key="i" v-for="(formAttribute, i) in formAttributes" :class="styleClass">
                <!-- Form Input Text -->
                <div v-if="formAttribute.type == 'text'" class="mt-4">
                    <label class="mb-2">{{ $t(formAttribute.name) }}</label>
                    <span v-if="formAttribute.required">
                        <vs-input v-validate="'required'" size="small" v-model="form.attribute[formAttribute.name]" :placeholder="$t(formAttribute.name)" :name="formAttribute.name" class="w-full" />
                        <span class="text-danger text-sm" size="small" v-show="errors.has(formAttribute.name)">{{ $t("required_"+formAttribute.name)
                        }}</span>
                    </span>
                    <vs-input v-else :placeholder="$t(formAttribute.name)" size="small" v-model="form.attribute[formAttribute.name]" :name="formAttribute.name"
                        class="w-full" />
                </div>

                <!-- Form Input Number -->
                <div v-if="formAttribute.type == 'number'" class="mt-4">
                    <label class="mb-2">{{ $t(formAttribute.name) }}</label>
                    <span v-if="formAttribute.required">
                        <vs-input-number :label="$t(formAttribute.name)" v-model="form.attribute[formAttribute.name]" icon-inc="expand_less" icon-dec="expand_more" class="w-full" />
                        <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{ $t("required_"+formAttribute.name)
                        }}</span>
                    </span>
                    <vs-input-number v-else :label="$t(formAttribute.name)" v-model="form.attribute[formAttribute.name]" icon-inc="expand_less" icon-dec="expand_more" class="w-full" />
                </div>

                <!-- Form Select -->
                <div v-if="formAttribute.type == 'select'" class="mt-4">
                    <label class="mb-2">{{ $t(formAttribute.name) }}</label>
                    <span v-if="formAttribute.required">
                        <v-select :name="formAttribute.name" v-model="form.attribute[formAttribute.name]" :options="formAttribute.options" :dir="$vs.rtl ? 'rtl' : 'ltr'"
                            v-validate="'required'" />
                        <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{ $t("required_"+formAttribute.name)
                            }}</span>
                    </span>
                    <span v-else>
                        <v-select v-model="form.attribute[formAttribute.name]" @v-blur="onChange($event)" :options="formAttribute.options" :clearable="false" :dir="$vs.rtl ? 'rtl' : 'ltr'" class="w-full"></v-select>
                    </span>
                </div>

                <!-- Form Check Box -->
                <div v-if="formAttribute.type == 'checkbox'" class="mt-4">
                    <label class="mb-2">{{ $t(formAttribute.name) }}</label>
                    <span v-if="formAttribute.required">
                        <vs-checkbox v-model="form.attribute[formAttribute.name]"> {{$t(formAttribute.name)}}</vs-checkbox>
                    </span>
                    <span v-else>
                        <vs-checkbox :key="index" v-for="(rowf, index) in formAttribute.attributes" v-model="form.attribute[rowf.value]"> {{ $t(rowf.name)}}</vs-checkbox>
                    </span>
                </div>

                <!-- Form Textarea -->
                <div v-if="formAttribute.type == 'textarea'" class="mt-4">
                    <label class="mb-2">{{ $t(formAttribute.name) }}</label>
                    <span v-if="formAttribute.required">
                        <vs-textarea label="Label in Textarea" v-validate="'required'" class="w-full" v-model="form.attribute[formAttribute.name]" />
                        <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{ $t("required_" + formAttribute.name)
                        }}</span>
                    </span>
                    <span v-else>
                        <vs-textarea label="Label in Textarea" class="w-full" v-model="form.attribute[formAttribute.name]" />
                    </span>
                </div>

                <!-- Form Date -->
                <div v-if="formAttribute.type == 'date'" class="mt-4">
                    <label class="mb-2">{{ $t(formAttribute.name) }}</label>
                    <span v-if="formAttribute.required">
                        <flat-pickr v-validate="'required'" :name="formAttribute.name" v-model="form.attribute[formAttribute.name]" class="w-full"/>
                        <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{ $t("required_" + formAttribute.name)
                        }}</span>
                    </span>
                    <span v-else>
                        <flat-pickr v-model="form.attribute[formAttribute.name]" class="w-full"/>
                    </span>
                </div>
            </div>
            
        </div>
        <span class="pull-right">
            <vs-button type="filled" @click.prevent="submitForm" class="mt-5 block">{{$t("btn_save")}}</vs-button>
        </span>
    </div>
</template>

<script>
    import axios from "@/axios.js"
    import DFormInput from '@/views/form-builder/form-control/DFormInput.vue'
    import vSelect from 'vue-select'
    import flatPickr from 'vue-flatpickr-component';
    import 'flatpickr/dist/flatpickr.css';
    export default {
        props: {
            formAttributes: {
                required: true
            },
            data: {
                required: true
            },
            rowDisplay: {
                required: true
            },
            api: {
                type: String
            },
            dataInfo: { required: true }
        },
        data() {
            return {
                styleClass: "",
                formAttribute: "",
                dataFields: [],
                form: {
                    attribute: [
                        {
                            order_level: 1,
                            title: "",
                        }
                    ]
                },
                form_filter: [],
                date: null,
            }
        },
        components: {
            DFormInput,
            vSelect,
            flatPickr
        },
        computed: {
        },
        methods: {
            showNewForm() {
                this.form.attribute = [];
                this.formAttributes.forEach(_formAttribute => {
                    if (_formAttribute["hasDefault"]) {
                        this.form.attribute[_formAttribute["name"]] = _formAttribute["defaultOptions"];
                    }
                });
            },
            showDataForm(data) {
                // let _formAttribute = this.formAttributes;
                // for (let i = 0; i < _formAttribute.length; i++) {
                    //     this.form.attribute[_formAttribute[i]["name"]] = data[_formAttribute[i]["name"]];// "I got all";
                // }
                this.formAttributes.forEach(_formAttribute => {
                    this.form.attribute[_formAttribute["name"]] = data[_formAttribute["name"]];
                    this.$validator.validateAll().then(result => {
                    })
                });

            },
            onChange(e) {
                this.$validator.validateAll().then(result => {
                });
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
                console.log("ddd", this.dataFields);
                // return false;
                this.$validator.validateAll().then(result => {
                    if (result) {
                        let _data = this.dataFields;
                        this.$vs.loading();
                        if (this.dataInfo.id) {
                            let _id = this.dataInfo.id;
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
                                    })
                            })
                        }
                    }
                    this.$vs.loading.close();
                })
            }
        },  
        mounted() {
            
        },
        created()
        { 
            if (this.rowDisplay == "1grid") {
                this.styleClass = "vx-col lg:w-1/1 w-full";
            }
            if (this.rowDisplay == "2grid") {
                this.styleClass = "vx-col lg:w-1/2 w-full";
            }
            if (this.rowDisplay == "3grid") {
                this.styleClass = "vx-col lg:w-1/3 w-full";
            }   
            if (this.rowDisplay == "4grid") {
                this.styleClass = "vx-col lg:w-1/4 w-full";
            }
        },
    watch: {
        
        }
    }
</script>