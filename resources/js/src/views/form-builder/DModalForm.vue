<template>
    <div class="demo-alignment">
        <vs-popup classContent="popup-example" title="បំពេញព័ត៌មានខាងក្រោម" :active.sync="showModalForm">
            <d-form @clickForm="initTableData" ref="refModalForm" :data="data" :dataInfo="dataInfo"
                :formAttributes="formAttributes" :api="api" :rowDisplay="rowDisplay"></d-form>
        </vs-popup>
    </div>
</template>

<script>
import apiConfig from "@/apiConfig.js"
import DForm from '@/views/form-builder/DForm.vue'
import { ref } from 'vue';

export default {
    props: {
        data: {
            required: true,
        },
        api: { type: String },
        formAttributes: {
            required: true
        },
        rowDisplay: { type: String }
    },
    components: { DForm },
    data() {
        return {
            showModalForm: false,
            dataInfo: {

            }
        }
    },
    methods: {
        openNewForm() {
            this.showModalForm = true;
            this.$refs.refModalForm.showNewForm();
        },
        initForm(data) {
            this.showModalForm = true;
            this.dataInfo = data;
            this.$refs.refModalForm.showDataForm(data);
        },
        initTableData() {
            this.$emit('clicked');
            this.showModalForm = false;
        }
    }
}
</script>