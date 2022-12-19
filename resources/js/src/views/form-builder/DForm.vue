<template>
    <div>
        <div class="vx-row">
            <!-- {{dataInfo | json}} -->
            <div :key="i" v-for="(formAttribute, i) in formAttributes" :class="styleClass">
                <!-- Form Input Text -->
                <div v-if="formAttribute.type == 'text'">
                    <span v-if="formAttribute.required">
                        <vs-input v-validate="'required'" v-model="form.attribute[formAttribute.name]" :placeholder="$t(formAttribute.name)" :name="formAttribute.name" class="mt-5 w-full" />
                        <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{ $t("required_"+formAttribute.name)
                        }}</span>
                    </span>
                    <vs-input v-else :placeholder="$t(formAttribute.name)" v-model="form.attribute[formAttribute.name]" :name="formAttribute.name"
                        class="mt-5 w-full" />
                </div>
                <!-- Form Input Number -->
                <div v-if="formAttribute.type == 'number'">
                    <span v-if="formAttribute.required">
                        <!-- <vs-input v-validate="'required'" :placeholder="$t(formAttribute.name)" v-model="form.attribute[formAttribute.name]" :name="formAttribute.name" class="mt-5 w-full" /> -->
                        <vs-input-number :label="$t(formAttribute.name)" v-model="form.attribute[formAttribute.name]" icon-inc="expand_less" icon-dec="expand_more" class="mt-5 w-full" />
                        <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{ $t("required_"+formAttribute.name)
                        }}</span>
                    </span>
                    <vs-input-number v-else :label="$t(formAttribute.name)" v-model="form.attribute[formAttribute.name]" icon-inc="expand_less" icon-dec="expand_more" class="mt-5 w-full" />
                    <!-- <vs-input v-else :placeholder="$t(formAttribute.name)" v-model="form.attribute[formAttribute.name]" :name="formAttribute.name"
                        class="mt-5 w-full" /> -->
                </div>
                <!-- Form Select -->
                <div v-if="formAttribute.type == 'select'">
                    <span v-if="formAttribute.required">
                        <vs-select v-model="formAttribute[i]" class="mt-5 w-full">
                            <vs-select-item :key="item.value" :value="item.value" :text="item.text" v-for="item in formAttribute.data" />
                        </vs-select>
                    </span>
                    <span v-else>
                        <vs-select v-model="formAttribute[i]" class="mt-5 w-full">
                            <vs-select-item :key="item.value" :value="item.value" :text="item.text" v-for="item in formAttribute.data" />
                        </vs-select>
                    </span>
                </div>

                <!-- Form Check Box -->
                <div v-if="formAttribute.type == 'checkbox'" class="mt-6">
                    <span v-if="formAttribute.required">
                        <vs-checkbox v-model="formAttribute[i]"> {{$t(formAttribute.name)}}</vs-checkbox>
                        <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{ $t("required_"+formAttribute.name)
                            }}</span>
                    </span>
                    <span v-else>
                        <vs-checkbox v-model="formAttribute[i]"> {{$t(formAttribute.name)}}</vs-checkbox>
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
                            order_level: 1
                        }
                    ]
                }
            }
        },
        components: {
            DFormInput  
        },
        computed: {
        },
        methods: {
            showNewForm() {
                this.form.attribute = [];
            },
            showDataForm(data) {
                let _formAttribute = this.formAttributes;
                for (let i = 0; i < _formAttribute.length; i++) {
                    this.form.attribute[_formAttribute[i]["name"]] = data[_formAttribute[i]["name"]];// "I got all";
                }
                // this.form.attribute[this.formAttributes[0]["name"]] = "Hdddello";
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
        } 
    }
</script>