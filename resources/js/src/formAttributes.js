export default {
    // UnitForm
    formAttributeUnit: [
        {
            name: "name_en",
            type: "text",
            required: true
        },
        {
            name: "name_kh",
            type: "text",
            required: true
        },
        {
            name: "order_level",
            type: "number",
            required: false
        },
        {
            name: "remark",
            type: "textarea",
            required: false
        }
    ],
    // Entity
    formAttributeEntity: [
        {
            name: "code",
            type: "text",
            required: true
        },
        {
            name: "name_en",
            type: "text",
            required: true
        },
        {
            name: "name_kh",
            type: "text",
            required: true
        },
        {
            name: "order_level",
            type: "number",
            required: false
        },
        {
            name: "description",
            type: "textarea",
            required: false
        },
    ],
    // Title
    formAttributeTitle: [
        {
            name: "name_en",
            type: "text",
            required: true
        },
        {
            name: "name_kh",
            type: "text",
            required: true
        },
        {
            name: "order_level",
            type: "number",
            required: false
        },
        {
            name: "remark",
            type: "textarea",
            required: false
        }
    ],
    // Sub Account
    formAttributeSubAccount: [
        {
            name: "code",
            type: "text",
            required: true
        },
        {
            name: "account_id",
            type: "select",
            options: [],
            enableSelect: "",
            required: false
        },
        {
            name: "name_en",
            type: "text",
            required: true
        },
        {
            name: "name_kh",
            type: "text",
            required: true
        },
        {
            name: "order_level",
            type: "number",
            required: false
        },
        {
            name: "description",
            type: "textarea",
            required: false
        },
    ],
}