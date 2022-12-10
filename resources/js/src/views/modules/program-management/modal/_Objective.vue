<template>
        <div class="demo-alignment">
            <vs-popup classContent="popup-example" title="បំពេញព័ត៌មានខាងក្រោម" :active.sync="showModalForm">
                <d-form :formAttributes="formAttributes" :api="api"></d-form>
            </vs-popup>
        </div>
</template>

<script>
import DForm from '@/views/form-builder/DForm.vue'
  export default{
  components: { DForm },
      data() {
        return {
            showModalForm: true,
            api: "",
            formAttributes: [
                {
                    name: "order_level",
                    model: "order_level",
                    type: "text",
                    required: true,
                    placeholder: "តំរៀបតាមលំដាប់",
                },
                {
                    name: "name",
                    model: "name",
                    type: "text",
                    required: false,
                    placeholder:"ឈ្មោះ"
                },
                {
                    name: "name_kh",
                    model: "name_kh",
                    type: "text",
                    required: true,
                    placeholder: "ឈ្មោះជាភាសាខ្មែរ"
                },
            ],
        }
    },
    methods: {
        initForm(value) {
            this.showModalForm = true;
        },
    }
  }
</script>