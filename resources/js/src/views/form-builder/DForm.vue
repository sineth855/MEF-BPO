<template>
    <div>
        <vs-popup style="z-index: 5200000;" classContent="popup-example" :title="$t(title)"
            :active.sync="showModalForm">
            <DFormAttribute :data="data" :formAttributes="formAttributeData" :rowDisplay="rowDisplay" :api="newAPi"
                :dataInfo="dataInfo" :parentDataInfo="parentDataInfo" @clickForm="initTableData" />
        </vs-popup>
        <div class="vx-row">
            <template v-for="(formAttribute, i) in formAttributes">
                <!-- Form Input Text -->
                <div v-if="formAttribute.type == 'text'" :class="styleClass" dclass="mt-4">
                    <label class="mb-2">{{ $t(formAttribute.name) }}</label>
                    <span v-if="formAttribute.required">
                        <vs-input v-validate="'required'" size="small" v-model="form.attribute[formAttribute.name]"
                            :placeholder="$t(formAttribute.name)" :name="formAttribute.name" class="mt-1 w-full" />
                        <span class="text-danger text-sm" size="small" v-show="errors.has(formAttribute.name)">{{
                            $t("required_" + formAttribute.name)
                        }}</span>
                    </span>
                    <vs-input v-else v-validate="''" :placeholder="$t(formAttribute.name)" size="small"
                        v-model="form.attribute[formAttribute.name]" :name="formAttribute.name" class="mt-1 w-full" />
                </div>

                <!-- Form Input Number -->
                <div v-if="formAttribute.type == 'hidden' && formAttribute.required" :class="styleClass" dclass="mt-4">
                    <label>{{ $t(formAttribute.name) }} -- {{ data[formAttribute.name] }}</label>
                    <vs-input type="number" :placeholder="$t(formAttribute.name)"
                        v-model="form.attribute[formAttribute.name]" :value="data[formAttribute.name]"
                        :name="formAttribute.name" size="small" class="mt-2 w-full" />
                </div>

                <!-- Form Input Text -->
                <div v-if="formAttribute.type == 'password'" :class="styleClass" dclass="mt-4">
                    <label class="mb-2">{{ $t(formAttribute.name) }}</label>
                    <span v-if="formAttribute.required">
                        <vs-input type="password" v-validate="'required'" size="small"
                            v-model="form.attribute[formAttribute.name]" :placeholder="$t(formAttribute.name)"
                            :name="formAttribute.name" class="mt-1 w-full" />
                        <span class="text-danger text-sm" size="small" v-show="errors.has(formAttribute.name)">{{
                            $t("required_" + formAttribute.name)
                        }}</span>
                    </span>
                    <vs-input type="password" v-else v-validate="''" :placeholder="$t(formAttribute.name)" size="small"
                        v-model="form.attribute[formAttribute.name]" :name="formAttribute.name" class="mt-1 w-full" />
                </div>

                <!-- Form Input Number -->
                <div v-if="formAttribute.type == 'number'" :class="styleClass" dclass="mt-4">
                    <label class="mb-2">{{ $t(formAttribute.name) }}</label>
                    <span v-if="formAttribute.required">
                        <vs-input type="number" size="small" v-validate="'required'" :name="formAttribute.name"
                            v-model="form.attribute[formAttribute.name]" icon-inc="expand_less" icon-dec="expand_more"
                            class="mt-1 w-full" />
                        <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">
                            {{ $t("required_" + formAttribute.name) }}
                        </span>
                    </span>
                    <vs-input type="number" size="small" v-validate="''" v-else :name="formAttribute.name"
                        v-model="form.attribute[formAttribute.name]" icon-inc="expand_less" icon-dec="expand_more"
                        class="mt-1 w-full" />
                </div>

                <div v-if="formAttribute.type == 'select'" :class="styleClass" dclass="mt-4">
                    <label class="mb-2">{{ $t(formAttribute.name) }} <span
                            v-if="formAttribute.required">*</span></label>
                    <button v-if="formAttribute.name != 'year' && formAttribute.name != 'gender'" type="button"
                        @click.stop="initNewForm(formAttribute.name)">
                        <feather-icon v-if="formAttribute.name != 'year' && formAttribute.name != 'gender'"
                            type="button" @click.stop="initNewForm(formAttribute.name)" icon="PlusIcon"
                            svgClasses="h-4 w-4" />
                    </button>
                    <span v-if="formAttribute.required">
                        <!-- <vs-select :name="formAttribute.name" v-model="form.attribute[formAttribute.name]"
                            :dir="$vs.rtl ? 'rtl' : 'ltr'" v-validate="'required'" class="mt-1 w-full">
                            <vs-select-item :key="index" :value="item.value" :text="item.label"
                                v-for="(item, index) in data[formAttribute.name]" />
                        </vs-select> -->
                        <template v-if="formAttribute.hasFilter">
                            <!-- <v-select size="small"
                                v-on:input="onInitChange($event, formAttribute.filterObj, formAttribute.name, formAttribute.api)"
                                v-validate="'required'" v-model="form.attribute[formAttribute.name]"
                                :name="formAttribute.name" :options="data[formAttribute.name]"
                                :dir="$vs.rtl ? 'rtl' : 'ltr'" class="mt-1 w-full" />
                            <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{
                                $t("required_" + formAttribute.name)
                            }}</span> -->
                            <v-select size="small"
                                v-on:input="onInitChange($event, formAttribute.filterObj, formAttribute.name, formAttribute.api)"
                                v-validate="'required'" v-model="form.attribute[formAttribute.name]"
                                :name="formAttribute.name" :options="data[formAttribute.name]"
                                :dir="$vs.rtl ? 'rtl' : 'ltr'" class="mt-2 w-full" />
                            <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{
                                $t("required_" + formAttribute.name)
                            }}</span>
                            <!-- <v-select v-model="form.attribute[formAttribute.name]" :clearable="false"
                                :options="data[formAttribute.name]" v-validate="'required'" :name="formAttribute.name"
                                :dir="$vs.rtl ? 'rtl' : 'ltr'" />
                            <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{ $t("required_" +
                                formAttribute.name) }}</span> -->
                        </template>
                        <template v-else>
                            <v-select size="small" v-validate="'required'" :name="formAttribute.name"
                                v-model="form.attribute[formAttribute.name]" :options="data[formAttribute.name]"
                                :dir="$vs.rtl ? 'rtl' : 'ltr'" class="mt-1 w-full" />
                            <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{
                                $t("required_" + formAttribute.name)
                            }}</span>
                        </template>
                    </span>
                    <span v-else>
                        <template v-if="formAttribute.hasFilter">
                            <!-- <v-select size="small" v-validate="''"
                                v-on:input="onInitChange($event, formAttribute.filterObj, formAttribute.name, formAttribute.api)"
                                v-model="form.attribute[formAttribute.name]" :name="formAttribute.name"
                                :options="data[formAttribute.name]" :dir="$vs.rtl ? 'rtl' : 'ltr'" class="mt-1 w-full" /> -->
                            <v-select size="small" v-validate="''"
                                v-on:input="onInitChange($event, formAttribute.filterObj, formAttribute.name, formAttribute.api)"
                                v-model="form.attribute[formAttribute.name]" :name="formAttribute.name"
                                :options="data[formAttribute.name]" :dir="$vs.rtl ? 'rtl' : 'ltr'"
                                class="mt-2 w-full" />
                        </template>
                        <template v-else>
                            <v-select size="small" v-validate="''" :name="formAttribute.name"
                                v-model="form.attribute[formAttribute.name]" :options="data[formAttribute.name]"
                                :dir="$vs.rtl ? 'rtl' : 'ltr'" class="mt-1 w-full" />
                        </template>
                        <!-- <vs-select :name="formAttribute.name" v-validate="''" v-model="form.attribute[formAttribute.name]"
                            class="mt-1 w-full">
                            <vs-select-item :key="index" :value="item.value" :text="item.label"
                                v-for="(item, index) in data[formAttribute.name]" />
                        </vs-select> -->
                    </span>
                </div>

                <div v-if="formAttribute.type == 'select_autocomplete'" :class="styleClass" dclass="mt-4">
                    <label class="mb-2">{{ $t(formAttribute.name) }} - {{ form.attribute[formAttribute.name] }}</label>
                    <span v-if="formAttribute.required">
                        <vs-select :name="formAttribute.name" @change="onChangeElement($event, formAttribute.name)"
                            v-model="form.attribute[formAttribute.name]" :dir="$vs.rtl ? 'rtl' : 'ltr'"
                            v-validate="'required'" class="mt-1 w-full">
                            <vs-select-item :key="index" :value="item.value" :text="item.label"
                                v-for="(item, index) in data[formAttribute.name]" />
                        </vs-select>
                        <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{ $t("required_" +
                            formAttribute.name)
                            }}</span>
                    </span>
                    <span v-else>
                        <vs-select :name="formAttribute.name" @change="onChangeElement($event, formAttribute.name)"
                            v-model="form.attribute[formAttribute.name]" class="mt-1 w-full">
                            <vs-select-item :key="index" :value="item.value" :text="item.label"
                                v-for="(item, index) in data[formAttribute.name]" />
                        </vs-select>
                    </span>
                </div>

                <!-- Form Check Box -->
                <div v-if="formAttribute.type == 'checkbox'" :class="styleClass" dclass="mt-4">
                    <label class="mb-2">{{ $t(formAttribute.name) }}</label>
                    <span v-if="formAttribute.required">
                        <vs-checkbox v-model="form.attribute[formAttribute.name]">
                            {{ $t(formAttribute.name) }}
                        </vs-checkbox>
                    </span>
                    <span v-else>
                        <!-- <vs-checkbox v-model="form.attribute[formAttribute.name]"> {{$t(formAttribute.name)}}</vs-checkbox> -->
                        <!-- <vs-checkbox v-model="form.attribute[rowf.value]" v-for="(rowf, index) in formAttribute.attributes"> {{ $t(rowf.name)}}</vs-checkbox> -->
                        <vs-checkbox v-model="form.attribute[formAttribute.name]">
                            {{ $t(formAttribute.name) }}
                        </vs-checkbox>
                    </span>
                </div>

                <!-- Form Textarea -->
                <div v-if="formAttribute.type == 'textarea'" :class="styleClass" dclass="mt-4">
                    <label class="mb-2">{{ $t(formAttribute.name) }}</label>
                    <span v-if="formAttribute.required">
                        <vs-textarea v-validate="'required'" class="mt-1 w-full"
                            v-model="form.attribute[formAttribute.name]" />
                        <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{ $t("required_" +
                            formAttribute.name)
                            }}</span>
                    </span>
                    <span v-else>
                        <vs-textarea v-validate="''" class="mt-1 w-full" v-model="form.attribute[formAttribute.name]" />
                    </span>
                </div>

                <!-- Form Date -->
                <div v-if="formAttribute.type == 'date'" :class="styleClass" dclass="mt-4">
                    <label class="mb-2">{{ $t(formAttribute.name) }}</label>
                    <span v-if="formAttribute.required">
                        <flat-pickr v-validate="'required'" size="small" :name="formAttribute.name"
                            v-model="form.attribute[formAttribute.name]" class="mt-1 w-full" />
                        <span class="text-danger text-sm" v-show="errors.has(formAttribute.name)">{{ $t("required_" +
                            formAttribute.name)
                            }}</span>
                    </span>
                    <span v-else>
                        <flat-pickr v-validate="''" v-model="form.attribute[formAttribute.name]" class="mt-1 w-full" />
                    </span>
                </div>

                <!-- Form Group -->
                <div v-if="formAttribute.type == 'text_group'" class="mt-4 vx-col lg:w-1/1 w-full" d>
                    <div>
                        <label class="mb-2">{{ $t(formAttribute.name) }}</label>
                        <div :key="j" v-for="(childformAttribute, j) in formAttribute.child_form"
                            class="vx-col lg:w-1/1 w-full">

                            <!-- Form Dynamic -->
                            <!-- Form Input Text -->
                            <div v-if="childformAttribute.type == 'text'" class="mt-4">
                                <label class="mb-2">{{ $t(childformAttribute.name) }}</label>
                                <span v-if="childformAttribute.required">
                                    <vs-input v-validate="'required'" size="small"
                                        v-model="form.attribute[childformAttribute.name]"
                                        :placeholder="$t(childformAttribute.name)" :name="childformAttribute.name"
                                        class="mt-1 w-full" />
                                    <span class="text-danger text-sm" size="small"
                                        v-show="errors.has(childformAttribute.name)">{{
                                            $t("required_" +
                                                childformAttribute.name)
                                        }}</span>
                                </span>
                                <vs-input v-else :placeholder="$t(childformAttribute.name)" size="small"
                                    v-model="form.attribute[childformAttribute.name]" :name="childformAttribute.name"
                                    class="mt-1 w-full" />
                            </div>

                            <!-- Form Input Number -->
                            <div v-if="childformAttribute.type == 'number'" class="mt-4">
                                <label class="mb-2">{{ $t(childformAttribute.name) }}</label>
                                <span v-if="childformAttribute.required">
                                    <vs-input-number :name="childformAttribute.name"
                                        v-model="form.attribute[childformAttribute.name]" icon-inc="expand_less"
                                        icon-dec="expand_more" class="mt-1 w-full" />
                                    <span class="text-danger text-sm" v-show="errors.has(childformAttribute.name)">{{
                                        $t("required_" + childformAttribute.name)
                                    }}</span>
                                </span>
                                <vs-input-number v-else :name="childformAttribute.name"
                                    v-model="form.attribute[childformAttribute.name]" icon-inc="expand_less"
                                    icon-dec="expand_more" class="mt-1 w-full" />
                            </div>

                            <div v-if="childformAttribute.type == 'select'" class="mt-4">
                                <label class="mb-2">{{ $t(childformAttribute.name) }}</label>
                                <span v-if="childformAttribute.required">
                                    <vs-select :name="childformAttribute.name"
                                        v-model="form.attribute[childformAttribute.name]" :dir="$vs.rtl ? 'rtl' : 'ltr'"
                                        v-validate="'required'" class="mt-1 w-full">
                                        <vs-select-item :key="index" :value="item.value" :text="item.label"
                                            v-for="(item, index) in data[childformAttribute.name]" />
                                    </vs-select>
                                    <span class="text-danger text-sm" v-show="errors.has(childformAttribute.name)">{{
                                        $t("required_" + childformAttribute.name)
                                    }}</span>
                                </span>
                                <span v-else>
                                    <vs-select :name="childformAttribute.name"
                                        v-model="form.attribute[childformAttribute.name]" class="mt-1 w-full">
                                        <vs-select-item :key="index" :value="item.value" :text="item.label"
                                            v-for="(item, index) in data[childformAttribute.name]" />
                                    </vs-select>
                                </span>
                            </div>

                            <!-- Form Check Box -->
                            <div v-if="childformAttribute.type == 'checkbox'" class="mt-4">
                                <label class="mb-2">{{ $t(childformAttribute.name) }}</label>
                                <span v-if="childformAttribute.required">
                                    <vs-checkbox :key="index" v-model="form.attribute[childformAttribute.name]">
                                        <!-- {{$t(childformAttribute.name) }}--></vs-checkbox>
                                </span>
                                <span v-else>
                                    <!-- <vs-checkbox :key="index" v-model="form.attribute[childformAttribute.name]"> {{$t(childformAttribute.name)}}</vs-checkbox> -->
                                    <!-- <vs-checkbox :key="index" v-model="form.attribute[rowf.value]" v-for="(rowf, index) in childformAttribute.attributes"> {{ $t(rowf.name)}}</vs-checkbox> -->
                                    <vs-checkbox :key="index" v-model="form.attribute[childformAttribute.name]"
                                        v-for="(rowf, index) in childformAttribute.attributes"> {{ $t(rowf.name)
                                        }}</vs-checkbox>
                                </span>
                            </div>

                            <!-- Form Textarea -->
                            <div v-if="childformAttribute.type == 'textarea'" class="mt-4">
                                <label class="mb-2">{{ $t(childformAttribute.name) }}</label>
                                <span v-if="childformAttribute.required">
                                    <vs-textarea v-validate="'required'" class="mt-1 w-full"
                                        v-model="form.attribute[childformAttribute.name]" />
                                    <span class="text-danger text-sm" v-show="errors.has(childformAttribute.name)">{{
                                        $t("required_" + childformAttribute.name)
                                    }}</span>
                                </span>
                                <span v-else>
                                    <vs-textarea class="mt-1 w-full"
                                        v-model="form.attribute[childformAttribute.name]" />
                                </span>
                            </div>

                            <!-- Form Date -->
                            <div v-if="childformAttribute.type == 'date'" class="mt-4">
                                <label class="mb-2">{{ $t(childformAttribute.name) }}</label>
                                <span v-if="childformAttribute.required">
                                    <flat-pickr v-validate="'required'" :name="childformAttribute.name"
                                        v-model="form.attribute[childformAttribute.name]" class="mt-1 w-full" />
                                    <span class="text-danger text-sm" v-show="errors.has(childformAttribute.name)">{{
                                        $t("required_" + childformAttribute.name)
                                    }}</span>
                                </span>
                                <span v-else>
                                    <flat-pickr v-model="form.attribute[childformAttribute.name]" class="mt-1 w-full" />
                                </span>
                            </div>
                            <!-- #End Form Dynamic -->

                        </div>
                    </div>
                </div>

                <!-- Form Grid -->
                <div v-if="formAttribute.type == 'grid'" class="mt-4 vx-col lg:w-1/1 w-full">
                    <!-- <vs-alert icon="warning" active="true" color="primary" class="mt-5"> -->
                    <div style="background-color:#253358; color: #ffffff; padding: 5px;"><span>{{ $t(formAttribute.name)
                            }}</span></div>
                    <!-- </vs-alert> -->
                </div>

            </template>
        </div>
        <span class="pull-right">
            <vs-button type="filled" @click.prevent="submitForm" class="mt-5 block">{{
                $t("btn_save") }}</vs-button>
        </span>
    </div>
</template>

<script>
import apiConfig from "@/apiConfig.js"
import axios from "@/axios.js";
import formAttr from "@/formAttributes.js"
// import DFormInput from '@/views/form-builder/form-control/DFormInput.vue';
import vSelect from 'vue-select';
import flatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
// import DModalForm from '@/views/form-builder/DModalForm.vue';
import DFormAttribute from '@/views/form-builder/DFormAttribute.vue';
// import Unit from '@/views/settings/_Unit.vue';
export default {
    props: {
        formAttributes: {
            required: Array
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
        dataInfo: {
            required: true
        },
        parentDataInfo: {
            required: true
        },
    },
    data() {
        return {
            newAPi: null,
            formAttributeData: [],
            dataTables: [],
            dataAttributes: "",
            title: "ទម្រង់បង្កើត",
            // initTableData: "",
            styleClass: "",
            formAttribute: "",
            dataFields: [],
            showModalForm: false,
            form: {
                attribute: {
                }
            },
            form_filter: [],
            date: null,
        }
    },
    components: {
        // DFormInput,
        vSelect,
        flatPickr,
        // DModalForm,
        DFormAttribute,
        formAttr
        // Unit
    },
    computed: {
        validateForm() {
            return !this.errors.any()
        }
    },
    methods: {
        initTableData(data) {
            var _flag = 1; // mean to enable close modal form
            this.showModalForm = false;
            this.$emit('clickForm', _flag);
        },
        initNewForm(param) {
            switch (param) {
                case "account_group_id":
                    this.title = "account_group_id";
                    this.newAPi = apiConfig._apiAccountGroup;
                    this.formAttributeData = formAttr.formAttributeAccountGroup;
                    break;

                case "account_type_group_id":
                    this.title = "account_group_id";
                    this.newAPi = apiConfig._apiAccountTypeGroup;
                    this.formAttributeData = formAttr.formAttributeAccountTypeGroup;
                    break;
                case "account_type_id":
                    this.title = "account_type_id";
                    this.newAPi = apiConfig._apiAccountType;
                    this.formAttributeData = formAttr.formAttributeAccountType;
                    break;
                case "account_id":
                    this.title = "account_id";
                    this.newAPi = apiConfig._apiAccount;
                    this.formAttributeData = formAttr.formAttributeAccount;
                    break;
                case "sub_account_id":
                    this.title = "sub_account_id";
                    this.newAPi = "";
                    this.formAttributeData = formAttr.formAttributeAccount;
                    break;
                case "category_id":
                    this.title = "category_id";
                    this.newAPi = apiConfig._apiItemCategory;
                    this.formAttributeData = formAttr.formAttributeItemCategory;
                    break;
                case "item_id":
                    this.title = "item_id";
                    this.newAPi = apiConfig._apiItem;
                    this.formAttributeData = formAttr.formAttributeItem;
                    break;
                case "role_id":
                    this.title = "role_id";
                    this.newAPi = apiConfig._apiRole;
                    this.formAttributeData = formAttr.formAttributeRole;
                    break;
                case "unit_id":
                    this.title = "unit_id";
                    this.newAPi = apiConfig._apiUnit;
                    this.formAttributeData = formAttr.formAttributeUnit;
                    break;
                case "user_id":
                    this.title = "user_id";
                    this.newAPi = apiConfig._apiUser;
                    this.formAttributeData = formAttr.formAttributeUser;
                    break;
                case "title":
                    this.title = "title";
                    this.newAPi = apiConfig._apiTitle;
                    this.formAttributeData = formAttr.formAttributeTitle;
                    break;
                case "department":
                    this.title = "department";
                    this.newAPi = apiConfig._apiDepartment;
                    this.formAttributeData = formAttr.formAttributeDepartment;
                    break;
                case "entity_id":
                    this.title = "entity_id";
                    this.newAPi = apiConfig._apiEntity;
                    this.formAttributeData = formAttr.formAttributeEntity;
                    break;
                case "entity_member_id":
                    this.title = "entity_member_id";
                    this.newAPi = apiConfig._apiEntityMember;
                    this.formAttributeData = formAttr.formAttributeEntityMember;
                    break;
                case "position":
                    this.title = "position";
                    this.newAPi = apiConfig._apiPosition;
                    this.formAttributeData = formAttr.formAttributePosition;
                    break;
                case "ceiling_group_id":
                    this.title = "ceiling_group_id";
                    this.newAPi = apiConfig._apiCeilingGroup;
                    this.formAttributeData = formAttr.formAttributeCeilingGroup;
                    break;
                case "ceiling_type_id":
                    this.title = "ceiling_type_id";
                    this.newAPi = apiConfig._apiCeilingType;
                    this.formAttributeData = formAttr.formAttributeCeilingType;
                    break;
                case "objective_id":
                    this.title = "objective_id";
                    this.newAPi = apiConfig._apiObjective;
                    this.formAttributeData = formAttr.formAttributeObjective;
                    break;

                case "program_id":
                    this.title = "program_id";
                    this.newAPi = apiConfig._apiProgram;
                    this.formAttributeData = formAttr.formAttributeProgram;
                    break;
                case "sub_program_id":
                    this.title = "sub_program_id";
                    this.newAPi = apiConfig._apiSubProgram;
                    this.formAttributeData = formAttr.formAttributeSubProgram;
                    break;
                case "cluster_activity_id":
                    this.title = "cluster_activity_id";
                    this.newAPi = apiConfig._apiClusterActivity;
                    this.formAttributeData = formAttr.formAttributeClusterActivity;
                    break;
                case "activity_id":
                    this.title = "activity_id";
                    this.newAPi = apiConfig._apiActivity;
                    this.formAttributeData = formAttr.formAttributeActivity;
                    break;
                default:
                    this.formAttributeData = null;
                    break;
            }
            this.$emit('clickOpenNewPop', param);
            // this.$ref.refModalOpenNewPop.initOpenNewPop();
            this.showModalForm = true;
        },
        onInitChange($event, _formAttribute, _formName, _apiRequest) {
            let _data = {
                type: "autocomplete",
                param: this.form.attribute[_formName]
            };
            this.form.attribute[_formAttribute] = null;
            this.data[_formAttribute] = [];
            // this.data[_formAttribute].push([
            //     {
            //         "label": "sdf",
            //         "value": "1"
            //     }
            // ]);
            return new Promise((resolve, reject) => {
                axios.post(_apiRequest, _data)
                    .then((response) => {
                        this.$vs.notify({
                            title: 'Message',
                            text: "Loading...",
                            iconPack: 'feather',
                            icon: 'icon-check-circle',
                            color: 'primary',
                            position: 'top-right'
                        });
                        console.log(response["data"]["data"]);
                        for (let i = 0; i < response["data"]["data"].length; i++) {
                            // let _d = {
                            //     "label": response["data"]["data"][i]["label"],
                            //     "value": response["data"]["data"][i]["value"],
                            // }
                            // this.data[_formAttribute].push(_d);
                            this.data[_formAttribute].push(response["data"]["data"][i]);
                        }
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
        },
        emitValue(e) {
            let value = e.target.value
            if (this.modelModifiers.capitalize) {
                value = value.charAt(0).toUpperCase() + value.slice(1)
            }
            this.$emit('update:modelValue', value)
        },
        // Just test to create dynamic data table on form
        onChangeElement(e, form_name) {
            // this.form.attribute[form_name] = "";
            this.$emit('clicked', e)
            // this.$refs.refInitPushDataTable.initPushDataTable(form_name);
        },
        showNewForm(data) {
            this.form.attribute = [];
            this.formAttributes.forEach(_formAttribute => {
                if (_formAttribute["hasDefault"]) {
                    this.form.attribute[_formAttribute["name"]] = _formAttribute["defaultOptions"]["value"];
                } else if (_formAttribute["type"] == "hidden") {
                    this.form.attribute[_formAttribute["name"]] = data["id"];
                }
            });
        },
        showNewFormByParent(obj) {
            console.log("data objec", obj);
            this.form.attribute = [];
            this.formAttributes.forEach(_formAttribute => {
                this.form.attribute[_formAttribute["name"]] = "";
                if (_formAttribute["type"] == "select") {
                    this.form.attribute[_formAttribute["name"]] = obj[_formAttribute["name"]];
                    // this.form.attribute[_formAttribute["name"]] = "";
                }
                if (_formAttribute["name"] == obj.field) {
                    this.form.attribute[_formAttribute["name"]] = obj[_formAttribute["name"]];
                }
                // if (_formAttribute["type"] == "select") {
                //     this.form.attribute[_formAttribute["name"]] = "";
                // }
                // if (_formAttribute["name"] == obj.field) {
                //     this.form.attribute[obj.field] = obj.id;
                // }
            });
        },
        showDataForm(data) {
            // this.form.attribute["budget_template_id"] = 111;
            //// let _formAttribute = this.formAttributes;
            //// for (let i = 0; i < _formAttribute.length; i++) {
            ////     this.form.attribute[_formAttribute[i]["name"]] = data[_formAttribute[i]["name"]];// "I got all";
            //// }
            this.formAttributes.forEach(_formAttribute => {
                if (_formAttribute["type"] == "select") {
                    this.form.attribute[_formAttribute["name"]] = data[_formAttribute["name"]];
                } else if (_formAttribute["type"] == "hidden") {
                    this.form.attribute[_formAttribute["name"]] = data[_formAttribute["name"]];
                } else {
                    this.form.attribute[_formAttribute["name"]] = data[_formAttribute["name"]];
                }
                this.$validator.validateAll().then(result => {
                })
            });
        },
        onChange(e) {
            this.$validator.validateAll().then(result => {
            });
        },
        submitForm() {
            let _d;
            this.dataFields = [];
            let _formAttribute = this.formAttributes;
            this.formAttributes.forEach(_formAttribute => {
                if (_formAttribute["type"] == "select") {
                    if (typeof this.form.attribute[_formAttribute["name"]] !== 'undefined') {
                        _d = {
                            [_formAttribute["name"]]: this.form.attribute[_formAttribute["name"]].value
                        }
                    } else {
                        _d = {
                            [_formAttribute["name"]]: this.form.attribute[_formAttribute["name"]]
                        }
                    }
                } else {
                    _d = {
                        [_formAttribute["name"]]: this.form.attribute[_formAttribute["name"]]
                    }
                }
                this.dataFields.push(_d);
            });
            this.$validator.validateAll().then(result => {
                if (result) {
                    let _data = this.dataFields;
                    // this.$vs.loading();
                    if (this.dataInfo.id) {
                        let _id = this.dataInfo.id;
                        // this.$vs.loading.close();
                        return new Promise((resolve, reject) => {
                            axios.put(this.api + '/' + _id, _data)
                                .then((response) => {
                                    if (response.data.success == false) {
                                        this.$vs.notify({
                                            title: 'Message',
                                            text: response.data.message,
                                            iconPack: 'feather',
                                            icon: 'icon-check-circle',
                                            color: 'danger',
                                            position: 'top-right'
                                        })
                                    } else {
                                        this.$vs.notify({
                                            title: 'Message',
                                            text: response.data.message,
                                            iconPack: 'feather',
                                            icon: 'icon-check-circle',
                                            color: 'primary',
                                            position: 'top-right'
                                        })
                                        this.$emit('clickForm', '');
                                    }
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
                                    if (response.data.message) {
                                        this.$vs.notify({
                                            title: 'Message',
                                            text: response.data.message,
                                            iconPack: 'feather',
                                            icon: 'icon-check-circle',
                                            color: 'primary',
                                            position: 'top-right'
                                        })
                                    } else {
                                        this.$vs.notify({
                                            title: 'Message',
                                            text: response.data.message,
                                            iconPack: 'feather',
                                            icon: 'icon-check-circle',
                                            color: 'danger',
                                            position: 'top-right'
                                        })
                                        this.$vs.loading.close();
                                    }

                                    this.$emit('clickForm', '');
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
    mounted() {

    },
    created() {
        // this.form.attribute["budget_template_id"] = 11;
        if (this.rowDisplay == "1grid") {
            this.styleClass = "vx-col lg:w-1/1 w-full mt-4";
        }
        if (this.rowDisplay == "2grid") {
            this.styleClass = "vx-col lg:w-1/2 w-full mt-4";
        }
        if (this.rowDisplay == "3grid") {
            this.styleClass = "vx-col lg:w-1/3 w-full mt-4";
        }
        if (this.rowDisplay == "4grid") {
            this.styleClass = "vx-col lg:w-1/4 w-full mt-4";
        }
        if (this.rowDisplay == "full-grid") {
            this.styleClass = "vx-col lg:w-1/1 w-full";
        }
    },
    watch: {

    }
}
</script>