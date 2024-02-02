<template>
    <div class="demo-alignment">
        <vs-popup v-if="dataAttributes.popupFullscreen" fullscreen classContent="popup-example" :title="title"
            :active.sync="showModalForm">
            <!-- Modal Indicator Sub Program-->
            <!-- <modal-indicator-sub-program v-if="dataAttributes.hasIndicatorSubPro" :dataInfo="dataInfo"
                ref="refInitRequest"></modal-indicator-sub-program> -->

            <span v-if="!dataAttributes.hideFormData">
                <d-form @clickForm="initTableData" ref="refModalForm" :data="data" :dataInfo="dataInfo"
                    :formAttributes="formAttributes" :api="api" :rowDisplay="rowDisplay"></d-form>
            </span>
            <!-- <d-indicator v-if="dataAttributes.hasIndicatorSubPro" :dataInfo="dataInfo"
                :dataAttributes="dataAttributes"></d-indicator> -->
        </vs-popup>

        <vs-popup v-else classContent="popup-example" :title="title" :active.sync="showModalForm">
            <d-form @clickForm="initTableData" ref="refModalForm" :data="data" :dataInfo="dataInfo"
                :formAttributes="formAttributes" :api="api" :rowDisplay="rowDisplay"></d-form>
            <!-- <d-indicator v-if="dataAttributes.hasIndicator" :dataInfo="dataInfo"
                :dataAttributes="dataAttributes"></d-indicator> -->

            <!-- Modal Indicator Sub Program-->
            <!-- <modal-indicator-sub-program v-if="dataAttributes.hasIndicatorSubPro" :dataInfo="dataInfo"
                ref="refInitRequest"></modal-indicator-sub-program> -->
        </vs-popup>
    </div>
</template>

<script>
import apiConfig from "@/apiConfig.js"
import DForm from '@/views/form-builder/DForm.vue'
import { ref } from 'vue';
import DIndicator from '@/views/form-builder/DIndicator.vue';
import ModalIndicatorSubProgram from '@/views/modules/program-management/indicator/_modal_indicator_subprogram.vue';

export default {
    props: {
        data: {
            required: true,
        },
        api: { type: String },
        formAttributes: {
            required: true
        },
        dataAttributes: {
            required: true
        },
        rowDisplay: { type: String },
        title: {
            required: true,
        }
    },
    components: { DForm, ModalIndicatorSubProgram },
    data() {
        return {
            showModalForm: false,
            dataInfo: {},
            dataIndicators: [
                {
                    id: "23",
                    code: "12-",
                    indicator_name: "ឈ្មោះសូចនាករ",
                }
            ]
        }
    },
    methods: {
        // To show popup form when create new data
        openNewForm() {
            this.dataInfo = {};
            this.showModalForm = true;
            this.$refs.refModalForm.showNewForm();
        },
        openNewFormByParent(obj) {
            this.dataInfo = {};
            this.showModalForm = true;
            this.$refs.refModalForm.showNewFormByParent(obj);
        },
        initForm(data) {
            this.showModalForm = true;
            this.dataInfo = data;
            this.$refs.refModalForm.showDataForm(data);
            this.$refs.refInitRequest.showRequestData(data);
        },
        initTableData() {
            this.$emit('clicked');
            this.showModalForm = false;
        }
    },
    created() {
        // console.log("check data form objects", this.data);
    }
}
</script>