<template>
    <div>
        <div class="vx-row">
            <div :key="i" v-for="(formAttribute, i) in formAttributes" :class="styleClass">
                <!-- Form Input Text -->
                <div v-if="formAttribute.type == 'text'">
                    <span v-if="formAttribute.required">
                        <vs-input v-validate="'required|alpha'" :placeholder="$t(formAttribute.name)" v-model="formAttribute[i]" :name="formAttribute.name" class="mt-5 w-full" />
                        <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{ $t("required_"+formAttribute.name)
                        }}</span>
                    </span>
                    <vs-input v-else :placeholder="$t(formAttribute.name)" v-model="formAttribute[i]" :name="formAttribute.name"
                        class="mt-5 w-full" />
                </div>
                <!-- Form Input Number -->
                <div v-if="formAttribute.type == 'number'">
                    <span v-if="formAttribute.required">
                        <vs-input v-validate="'required|alpha'" :placeholder="$t(formAttribute.name)" v-model="formAttribute[i]"
                            :name="formAttribute.name" class="mt-5 w-full" />
                        <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{ $t("required_"+formAttribute.name)
                        }}</span>
                    </span>
                    <vs-input v-else :placeholder="$t(formAttribute.name)" v-model="formAttribute[i]" :name="formAttribute.name"
                        class="mt-5 w-full" />
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
                required: true
            }
        },
        data() {
            return {
                styleClass: "",
                formAttribute: "",
                entities: [
                    {
                        id: 1,
                        name: "tes"
                    },
                    {
                        id: 2,
                        name: "tes"
                    }
                ],
                dataArr: []
            }
        },
        components: {
            DFormInput  
        },
        methods: {
            submitForm() {
                // console.log("field name", this.formAttributes[0]);
                // for (var k = 0; this.formAttributes.length > 0; k++){
                //     // this._arr.push(this.formAttributes[k]);
                //     console.log(this.formAttributes[k])
                // }
                // for (let i = 0; i < this.formAttributes.length; i++) {
                //     // this._arr.push(this.formAttributes[i]);
                //     if (this.formAttributes[i]) {
                //         // vm.push("test"+[i]);
                //     }
                //     console.log(this.formAttributes[i]);
                // }
                // for (let i = 0; i < this.entities.length; i++) {
                //     const _data = {
                //         id: this.entities[i]["id"]
                //     };
                //     this._arr.push({data: "testing"});
                // // }
                // console.log("push data", _arr);
                this.dataArr = [];
                for (let i = 0; i < this.formAttributes.length; i++) {
                    const _data = {
                        id: this.formAttributes[i],
                        // label: this.formAttributes[i]["name"]
                    };
                    this.dataArr.push(this.formAttributes[i][i]);
                }
                this.$validator.validateAll().then(result => {
                    if (result) {
                        if (result) {
                            let _data = {
                                // title: this.title,
                                // account: this.account.label,
                                // description: this.description,
                                // issue_date: this.issue_date,
                                // category: this.category.label,
                                // payment_method: this.payment_method.label,
                                // amount: parseFloat(this.amount),
                                // exchange_rate: parseInt(this.exchange_rate),
                                // reference: this.reference,
                                // entity: this.entity,
                                // currency: this.currency.label
                            }
                            if (this.$route.params.id) {
                                let _id = this.$route.params.id;
                                return new Promise((resolve, reject) => {
                                    axios.put(this.api + _id, _data)
                                        .then((response) => {
                                            this.$vs.notify({
                                                title: 'Message',
                                                text: response.data.message,
                                                iconPack: 'feather',
                                                icon: 'icon-check-circle',
                                                color: 'primary',
                                                position: 'top-right'
                                            })
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
                                            console.log("message", response);
                                            this.$vs.notify({
                                                title: 'Message',
                                                text: response.data.message,
                                                iconPack: 'feather',
                                                icon: 'icon-check-circle',
                                                color: 'primary',
                                                position: 'top-right'
                                            })
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
                        // this.$vs.notify({
                        //     title: 'Icon mail',
                        //     text: 'Lorem ipsum dolor sit amet, consectetur',
                        //     color: 'success',
                        //     iconPack: 'feather',
                        //     icon: 'icon-check',
                        //     position: 'top-right'
                        // });
                        // this.showObjective = false;
                    } else {
                        // form have errors
                    }
                })
            }
        },  
    created() {
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