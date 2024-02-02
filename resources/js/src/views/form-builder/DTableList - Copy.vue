<template>
    <vx-card :title="$t(title)" code-toggler>
        <d-modal-form @clicked="initTableData" ref="refModalForm" :data="dataTables" :api="api"
            :formAttributes="formAttributes" :rowDisplay="rowDisplay" :dataAttributes="dataAttributes"
            :title="$t(title)"></d-modal-form>

        <div v-if="dataAttributes.enableToggleForm" class="items-center data-list-btn-container">
            <div class="p-3 mr-4">
                <vs-button @click="openToggleForm" color="primary" type="filled">{{ $t("បន្ថែមគំរូប្រភេទចំណាត់ថ្នាក់")
                }}</vs-button>
            </div>
            <!-- ADD NEW -->
            <!-- <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary"
                @click="openToggleForm">
                <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
                <span class="ml-2 text-base text-primary">{{ $t("AddNew") }}</span>
            </div> -->
            <div class="p-3 mb-4" style="overflow: scroll;">
                <d-form v-if="enableToggleForm" @clicked="initPushDataTable" @clickForm="initTableData" :data="dataTables"
                    :dataInfo="dataInfo" :formAttributes="formAttributes" :api="api" :rowDisplay="rowDisplay"></d-form>

                <!-- <d-child-table></d-child-table> -->
                <vs-table style="min-width: 500px;min-width: 200%;">
                    <template slot="thead" style="background: #28c76f;">
                        <vs-th>{{ $t("ល.រ") }}</vs-th>
                        <vs-th>{{ $t("ឈ្មោះចំណាត់ថ្នាក់ចំណូល") }}</vs-th>
                        <vs-th>{{ $t("ច្បាប់ហិរញ្ញវត្ថុ") }}</vs-th>
                        <vs-th v-html="$t('ទឹកប្រាក់<small>(សរុបគម្រោងកម្មវិធីប្រចាំឆ្នាំ)</small>')"></vs-th>
                        <vs-th>{{ $t("%ច្បាប់") }}</vs-th>
                        <vs-th>{{ $t("គ្រោងចំណូលតាម ត្រីមាសទី១") }}</vs-th>
                        <vs-th>{{ $t("គ្រោងចំណូលតាម ត្រីមាសទី២") }}</vs-th>
                        <vs-th>{{ $t("គ្រោងចំណូលតាម ត្រីមាសទី៣") }}</vs-th>
                        <vs-th>{{ $t("គ្រោងចំណូលតាម ត្រីមាសទី៤") }}</vs-th>
                        <vs-th>{{ $t("ផ្សេងៗ") }}</vs-th>
                        <vs-th>{{ $t("Action") }}</vs-th>
                    </template>
                    <tbody>
                        <vs-tr style="background-color: rgb(85 255 161)">
                            <td colspan="11"><b>70-ចំណូលសារពើពន្ធក្នុងស្រុក</b></td>
                        </vs-tr>
                        <vs-tr style="background-color: #b2ffd9;">
                            <td colspan="11"><b>7001-ពន្ធផ្ទាល់ (ពន្ធលើផលទុន ប្រាក់ចំណូល)</b></td>
                        </vs-tr>
                        <vs-tr>
                            <vs-td><b>{{ "70025" }}</b></vs-td>
                            <vs-td style="width: 400px">{{ "អាករលើតម្លៃបន្ថែម របបនាំចូល (សហគ្រាសប្រេងឥន្ធនៈ)" }}</vs-td>
                            <td style="width: 200px">
                                <vs-input type="number" v-validate="'required'" size="small" class="w-full" />
                            </td>
                            <td style="width: 200px">
                                <vs-input type="number" v-validate="'required'" size="small" class="w-full" />
                            </td>
                            <td style="width: 200px">
                                <vs-input type="number" v-validate="'required'" size="small" class="w-full" />
                            </td>
                            <td style="width: 1500px">
                                <div style="background-color: rgb(178 255 217);">
                                    <center>ត្រីមាសទី១</center>
                                </div>
                                <div class="pb-3 pt-3"><vx-card>
                                        <center>គ្រោងដើមឆ្នាំ</center>
                                    </vx-card></div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ១<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ២<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៣<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3 pt-3">
                                    <center>ប៉ាន់ស្មានអនុវត្ត</center>
                                </div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ១<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ២<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៣<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 1500px">
                                <div style="background-color: rgb(178 255 217);">
                                    <center>ត្រីមាសទី២</center>
                                </div>
                                <div class="pb-3 pt-3"><vx-card>
                                        <center>គ្រោងដើមឆ្នាំ</center>
                                    </vx-card></div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៤<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៥<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៦<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3 pt-3">
                                    <center>ស្នើសុំកែតម្រូវ</center>
                                </div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៤<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៥<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៦<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 1500px">
                                <div style="background-color: rgb(178 255 217);">
                                    <center>ត្រីមាសទី៣</center>
                                </div>
                                <div class="pb-3 pt-3"><vx-card>
                                        <center>គ្រោងដើមឆ្នាំ</center>
                                    </vx-card></div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៧<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៨<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៩<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3 pt-3">
                                    <center>ស្នើសុំកែតម្រូវ</center>
                                </div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៦<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៧<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៨<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 1500px">
                                <div style="background-color: rgb(178 255 217);">
                                    <center>ត្រីមាសទី៤</center>
                                </div>
                                <div class="pb-3 pt-3"><vx-card>
                                        <center>គ្រោងដើមឆ្នាំ</center>
                                    </vx-card></div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ១០<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ១១<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ១២<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3 pt-3">
                                    <center>ស្នើសុំកែតម្រូវ</center>
                                </div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ១០<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ១១<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ១២<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 600px">
                                <vs-input v-validate="'required'" size="small" class="mb-2 pb-2 w-full" />
                            </td>
                            <td></td>
                        </vs-tr>
                        <vs-tr>
                            <vs-td>{{ "70025" }}</vs-td>
                            <vs-td style="width: 400px">{{ "អាករលើតម្លៃបន្ថែម របបនាំចូល (សហគ្រាសប្រេងឥន្ធនៈ)" }}</vs-td>
                            <td style="width: 200px">
                                <vs-input type="number" v-validate="'required'" size="small" class="w-full" />
                            </td>
                            <td style="width: 200px">
                                <vs-input type="number" v-validate="'required'" size="small" class="w-full" />
                            </td>
                            <td style="width: 200px">
                                <vs-input type="number" v-validate="'required'" size="small" class="w-full" />
                            </td>
                            <td style="width: 1500px">
                                <div style="background-color: rgb(178 255 217);">
                                    <center>ត្រីមាសទី១</center>
                                </div>
                                <div class="pb-3 pt-3"><vx-card>
                                        <center>គ្រោងដើមឆ្នាំ</center>
                                    </vx-card></div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ១<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ២<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៣<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3 pt-3">
                                    <center>ប៉ាន់ស្មានអនុវត្ត</center>
                                </div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ១<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ២<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៣<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 1500px">
                                <div style="background-color: rgb(178 255 217);">
                                    <center>ត្រីមាសទី២</center>
                                </div>
                                <div class="pb-3 pt-3"><vx-card>
                                        <center>គ្រោងដើមឆ្នាំ</center>
                                    </vx-card></div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៤<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៥<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៦<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3 pt-3">
                                    <center>ស្នើសុំកែតម្រូវ</center>
                                </div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៤<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៥<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៦<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 1500px">
                                <div style="background-color: rgb(178 255 217);">
                                    <center>ត្រីមាសទី៣</center>
                                </div>
                                <div class="pb-3 pt-3"><vx-card>
                                        <center>គ្រោងដើមឆ្នាំ</center>
                                    </vx-card></div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៧<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៨<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៩<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3 pt-3">
                                    <center>ស្នើសុំកែតម្រូវ</center>
                                </div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៦<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៧<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៨<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 1500px">
                                <div style="background-color: rgb(178 255 217);">
                                    <center>ត្រីមាសទី៤</center>
                                </div>
                                <div class="pb-3 pt-3"><vx-card>
                                        <center>គ្រោងដើមឆ្នាំ</center>
                                    </vx-card></div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ១០<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ១១<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ១២<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3 pt-3">
                                    <center>ស្នើសុំកែតម្រូវ</center>
                                </div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ១០<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ១១<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ១២<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 600px">
                                <vs-input v-validate="'required'" size="small" class="mb-2 pb-2 w-full" />
                            </td>
                            <td></td>
                        </vs-tr>
                        <vs-tr>
                            <vs-td>{{ "70025" }}</vs-td>
                            <vs-td style="width: 400px">{{ "អាករលើតម្លៃបន្ថែម របបនាំចូល (សហគ្រាសប្រេងឥន្ធនៈ)" }}</vs-td>
                            <td style="width: 200px">
                                <vs-input type="number" v-validate="'required'" size="small" class="w-full" />
                            </td>
                            <td style="width: 200px">
                                <vs-input type="number" v-validate="'required'" size="small" class="w-full" />
                            </td>
                            <td style="width: 200px">
                                <vs-input type="number" v-validate="'required'" size="small" class="w-full" />
                            </td>
                            <td style="width: 1500px">
                                <div style="background-color: rgb(178 255 217);">
                                    <center>ត្រីមាសទី១</center>
                                </div>
                                <div class="pb-3 pt-3"><vx-card>
                                        <center>គ្រោងដើមឆ្នាំ</center>
                                    </vx-card></div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ១<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ២<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៣<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3 pt-3">
                                    <center>ប៉ាន់ស្មានអនុវត្ត</center>
                                </div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ១<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ២<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៣<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 1500px">
                                <div style="background-color: rgb(178 255 217);">
                                    <center>ត្រីមាសទី២</center>
                                </div>
                                <div class="pb-3 pt-3"><vx-card>
                                        <center>គ្រោងដើមឆ្នាំ</center>
                                    </vx-card></div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៤<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៥<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៦<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3 pt-3">
                                    <center>ស្នើសុំកែតម្រូវ</center>
                                </div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៤<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៥<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៦<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 1500px">
                                <div style="background-color: rgb(178 255 217);">
                                    <center>ត្រីមាសទី៣</center>
                                </div>
                                <div class="pb-3 pt-3"><vx-card>
                                        <center>គ្រោងដើមឆ្នាំ</center>
                                    </vx-card></div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៧<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៨<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ៩<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3 pt-3">
                                    <center>ស្នើសុំកែតម្រូវ</center>
                                </div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៦<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៧<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ៨<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 1500px">
                                <div style="background-color: rgb(178 255 217);">
                                    <center>ត្រីមាសទី៤</center>
                                </div>
                                <div class="pb-3 pt-3"><vx-card>
                                        <center>គ្រោងដើមឆ្នាំ</center>
                                    </vx-card></div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ១០<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ១១<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                ខែ១២<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="pb-3 pt-3">
                                    <center>ស្នើសុំកែតម្រូវ</center>
                                </div>
                                <div class="vx-row">
                                    <div class="vx-col md:w-1/1 w-full">
                                        <div class="vx-row">
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ១០<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ១១<vs-input type="number" class="w-full" />
                                            </div>
                                            <div class="vx-col sm:w-1/3 w-full">
                                                អនុ.ខែ១២<vs-input type="number" class="w-full" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td style="width: 600px">
                                <vs-input v-validate="'required'" size="small" class="mb-2 pb-2 w-full" />
                            </td>
                            <td></td>
                        </vs-tr>
                    </tbody>
                </vs-table>

            </div>
        </div>

        <div v-else class="flex flex-wrap-reverse items-center data-list-btn-container">
            <!-- ADD NEW -->
            <div class="btn-add-new p-3 mb-4 mr-4 rounded-lg cursor-pointer flex items-center justify-center text-lg font-medium text-base text-primary border border-solid border-primary"
                @click="openForm">
                <feather-icon icon="PlusIcon" svgClasses="h-4 w-4" />
                <span class="ml-2 text-base text-primary">{{ $t("AddNew") }}</span>
            </div>
        </div>

        <d-heading-wizard v-if="dataAttributes.hasHeadingReport" :dataAttributes="dataAttributes"></d-heading-wizard>

        <d-search v-if="!dataAttributes.hideSearchBar" @searchQuery="searchQuery" @clicked="initTableData"
            :data="dataTables" :api="api" :formAttributes="formAttributes" :rowDisplay="'4grid'" :dataInfo="''"></d-search>

        <h3>
            <center>{{ $t(title) }}</center>
        </h3>
        <vs-table v-if="dataTables.data && dataTables.data.length && dataAttributes.tableStyle == 1"
            :max-items="dataTables.limit" :data="dataTables.data">
            <template slot-scope="{data}">
                <vs-tr style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                    <vs-td>{{ $t("no") }}</vs-td>
                    <vs-td :key="i" v-for="(header, i) in dataHeaders">{{ $t(header) }}</vs-td>
                    <vs-td>{{ $t("Action") }}</vs-td>
                </vs-tr>
                <vs-tr :key="indextr" v-for="(tr, indextr) in data">
                    <vs-td>{{ calPageIncreaseNumber(dataTables.limit, indextr) }}</vs-td>
                    <vs-td v-for="header in dataHeaders" :key="header.indextr">{{ tr[header] }}</vs-td>
                    <vs-td>
                        <template v-if="dataAttributes.actionButton">
                            <feather-icon style="cursor: pointer;" v-for="rowBtnAction in dataAttributes.actionButton"
                                :key="rowBtnAction.indextr" :icon="rowBtnAction.icon"
                                svgClasses="mr-2 w-5 h-5 hover:text-primary stroke-current"
                                @click.stop="viewUrl(rowBtnAction)" />
                        </template>
                        <feather-icon style="cursor: pointer;" icon="EditIcon"
                            svgClasses="w-5 h-5 hover:text-primary stroke-current" @click.stop="initEdit(tr)" />
                        <feather-icon style="cursor: pointer;" v-if="allowDel" icon="TrashIcon"
                            svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2"
                            @click.stop="initDel(tr.id)" />
                    </vs-td>
                </vs-tr>
            </template>
        </vs-table>

        <vs-table v-else-if="dataTables.data && dataTables.data.length && dataAttributes.tableStyle == 2"
            :max-items="dataTables.limit" :data="dataTables.data">
            <template slot="thead">
                <vs-th style="background-color: #28C76F; color: #ffffff; font-weight: bold;">{{ $t("no") }}</vs-th>
                <vs-th style="background-color: #28C76F; color: #ffffff; font-weight: bold;" :key="i"
                    v-for="(header, i) in dataHeaders">{{ $t(header) }}</vs-th>
                <vs-th style="background-color: #28C76F; color: #ffffff; font-weight: bold;">{{ $t("Action") }}</vs-th>
            </template>

            <template slot-scope="{data}">
                <tbody :key="pindextr" v-for="(ptr, pindextr) in data">
                    <vs-tr :state="dataAttributes.backgroundColor">
                        <!-- <td :colspan="Object.keys(ptr.children[0]).length">{{ ptr.name_kh }}</td> -->
                        <td :colspan="Object.keys(dataHeaders).length + 1">{{ ptr.code }}-{{ ptr.name_kh }}</td>
                        <td>
                            <center><feather-icon style="cursor: pointer;" @click="openFormByParent(ptr)" icon="PlusIcon"
                                    svgClasses="w-5 h-5 hover:text-primary stroke-current" /></center>
                        </td>
                    </vs-tr>
                    <template v-if="ptr.children.length > 0">
                        <vs-tr :key="indextr" v-for="(tr, indextr) in ptr.children">
                            <vs-td>{{ calPageIncreaseNumber(dataTables.limit, indextr) }}</vs-td>
                            <vs-td v-for="header in dataHeaders" :key="header.indextr">
                                <span v-if="tr[header].data">
                                    <span v-if="getDocumentSize(tr[header].data) > 0">
                                        <div class="mb-2" :key="indexI" v-for="(dataRow, indexI) in tr[header].data">
                                            <vx-card>
                                                {{ dataRow["code"] }}-{{ dataRow["kpi_name_kh"] }}
                                            </vx-card>
                                        </div>
                                    </span>
                                    <span v-else>
                                        <center>
                                            {{ $t("msg_no_indicator") }}
                                            <feather-icon style="cursor: pointer;" @click="openForm" icon="PlusIcon"
                                                svgClasses="w-5 h-5 hover:text-primary stroke-current" />
                                        </center>
                                    </span>
                                </span>
                                <span v-else>
                                    <center>{{ tr[header] }}</center>
                                </span>

                                <!-- <span v-if="tr[header].data"> -->
                                <!-- <span v-if="tr[header].data.length">
                                        <div class="mb-2" :key="indexI" v-for="(dataRow, indexI) in tr[header].data">
                                            <vx-card>
                                                {{ dataRow["code"] }}-{{ dataRow["kpi_name_kh"] }}
                                                <feather-icon style="cursor: pointer;" icon="EditIcon"
                                                    svgClasses="mt-2 w-5 h-5 hover:text-primary stroke-current" />
                                            </vx-card>
                                        </div>
                                    </span> -->
                                <!-- If No Data Indicators will create new -->
                                <!-- <span v-else>
                                        <center>
                                            {{ $t("msg_no_indicator") }}
                                            <feather-icon style="cursor: pointer;" @click="openForm" icon="PlusIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" />
                                        </center>
                                    </span> -->
                                <!-- </span> -->

                                <!-- <span v-else>{{ tr[header] }}​</span> -->

                                <!-- <span v-if="tr[header].data">
                                    <span v-if="tr[header].data.length">
                                        <div class="mb-2" :key="indexI" v-for="(dataRow, indexI) in tr[header].data">
                                            <vx-card>
                                                {{ dataRow["code"] }}-{{ dataRow["kpi_name_kh"] }}
                                                <feather-icon style="cursor: pointer;" icon="EditIcon" svgClasses="mt-2 w-5 h-5 hover:text-primary stroke-current"/>
                                            </vx-card>
                                        </div>
                                    </span> -->
                                <!-- If No Data Indicators will create new -->
                                <!-- <span v-else>
                                        <center>
                                            {{ $t("msg_no_indicator") }}
                                            <feather-icon style="cursor: pointer;" @click="openForm" icon="PlusIcon" svgClasses="w-5 h-5 hover:text-primary stroke-current" />
                                        </center>
                                    </span>
                                </span>
                                
                                <span v-else>{{ tr[header] }}​</span> -->

                            </vs-td>
                            <vs-td>
                                <!-- <template v-if="dataAttributes.actionButton">
                                    <feather-icon style="cursor: pointer;" v-for="rowBtnAction in dataAttributes.actionButton"
                                        :key="rowBtnAction.indextr" :icon="rowBtnAction.icon"
                                        svgClasses="mr-2 w-5 h-5 hover:text-primary stroke-current" @click.stop="viewUrl(rowBtnAction)" />
                                </template> -->
                                <feather-icon style="cursor: pointer;" icon="EditIcon"
                                    svgClasses="w-5 h-5 hover:text-primary stroke-current" @click.stop="initEdit(tr)" />
                                <feather-icon style="cursor: pointer;" v-if="allowDel" icon="TrashIcon"
                                    svgClasses="w-5 h-5 hover:text-danger stroke-current" class="ml-2"
                                    @click.stop="initDel(tr.id)" />
                            </vs-td>
                        </vs-tr>
                    </template>
                </tbody>
            </template>
        </vs-table>

        <vs-table v-if="dataTables.data && dataTables.data.length && dataAttributes.tableStyle == 3"
            :max-items="dataTables.limit" :data="dataTables.data" style="overflow: scroll">
            <template slot-scope="{data}">
                <vs-tr>
                    <vs-td :style="style(header)" :key="i" v-for="(header, i) in dataHeaders" :colspan="colspan(header)"
                        :rowspan="rowspan(header)">
                        <span v-if="header.label">
                            <center>{{ $t(header.label) }} </center>
                        </span>
                        <span v-else>
                            <center>{{ $t(header.label) }}</center>
                        </span>
                    </vs-td>
                </vs-tr>

                <vs-tr v-if="dataTables.dataHeaders" style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                    <vs-td :key="j" v-for="(header, j) in dataTables.dataHeaders" :colspan="colspan(header)"
                        :rowspan="rowspan(header)">{{ header.label }} </vs-td>
                </vs-tr>

                <vs-tr v-if="dataTables.dataSubHeaders"
                    style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                    <vs-td :key="k" v-for="(header, k) in dataTables.dataSubHeaders" :colspan="colspan(header)"
                        :rowspan="rowspan(header)"><small>{{ header.label }}</small></vs-td>
                </vs-tr>

                <tbody :key="pindextr" v-for="(ptr, pindextr) in data">
                    <vs-tr :state="'success'">
                        <template v-if="ptr.hasColspan == false">
                            <td>{{ ptr.name }}</td>
                            <td :key="index" v-for="(row, index) in ptr.values">{{ row }}</td>
                        </template>
                        <td v-else :colspan="ptr.colspan">{{ ptr.name }}</td>
                    </vs-tr>
                    <vs-tr :state="'primary'">
                        <td>{{ ptr.data.summary.name }}</td>
                        <td :key="index" v-for="(row, index) in ptr.data.summary.values">{{ row }}</td>
                        <td></td>
                    </vs-tr>

                    <template v-for="row in ptr.data.children">
                        <vs-tr :state="'warning'">
                            <td>{{ row.name }} <feather-icon style="cursor: pointer;" @click="openForm" icon="PlusIcon"
                                    svgClasses="w-5 h-5 hover:text-primary stroke-current" /></td>
                            <td :key="index1" v-for="(row, index1) in row.values">{{ row }} </td>
                            <td>
                                <center><feather-icon style="cursor: pointer;" @click="openForm" icon="PlusIcon"
                                        svgClasses="w-5 h-5 hover:text-primary stroke-current" /></center>
                            </td>
                        </vs-tr>
                        <vs-tr :key="index" v-for="(row2, index) in row.data">
                            <td>{{ row2.name }}</td>
                            <td :key="index3" v-for="(row, index3) in row2.values">{{ row }}</td>
                            <td></td>
                        </vs-tr>

                        <template v-for="row3 in row.dataDetails">
                            <vs-tr style="background-color: #fffde5">
                                <td>{{ row3.name }}</td>
                                <td :key="index4" v-for="(row, index4) in row.values">{{ row }}</td>
                                <td>
                                    <feather-icon style="cursor: pointer;" icon="EditIcon"
                                        svgClasses="w-5 h-5 hover:text-primary stroke-current"
                                        @click.stop="initEdit(row3)" />
                                    <!-- <template v-if="dataAttributes.actionButton">
                                        <feather-icon style="cursor: pointer;" v-for="rowBtnAction in dataAttributes.actionButton"
                                            :key="rowBtnAction.indextr" :icon="rowBtnAction.icon"
                                            svgClasses="mr-2 w-5 h-5 hover:text-primary stroke-current" @click.stop="viewUrl(rowBtnAction)" />
                                    </template> -->
                                </td>
                            </vs-tr>

                            <vs-tr :key="index" v-for="(row2, index) in row3.data">
                                <td>{{ row2.name }}</td>
                                <td :key="index3" v-for="(row, index3) in row2.values">{{ row }}</td>
                                <td></td>
                            </vs-tr>
                        </template>
                    </template>

                </tbody>
            </template>
        </vs-table>

        <vs-table v-if="dataTables.data && dataTables.data.length && dataAttributes.tableStyle == 4"
            :max-items="dataTables.limit" :data="dataTables.data" style="overflow: scroll">
            <template slot-scope="{data}">
                <vs-tr>
                    <vs-td :style="style(header)" :key="i" v-for="(header, i) in dataHeaders" :colspan="colspan(header)"
                        :rowspan="rowspan(header)">
                        <span v-if="header.label">
                            <center>{{ $t(header.label) }}</center>
                        </span>
                        <span v-else>
                            <center>{{ $t(header) }}</center>
                        </span>
                    </vs-td>
                </vs-tr>

                <vs-tr v-if="dataTables.dataHeaders" style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                    <vs-td :key="j" v-for="(sheader, j) in dataTables.dataHeaders">{{ sheader }}</vs-td>
                </vs-tr>

                <vs-tr v-if="dataTables.dataSubHeaders">
                    <vs-td :key="k" v-for="(sheader, k) in dataTables.dataSubHeaders"><small>{{ sheader }}</small></vs-td>
                </vs-tr>

                <tbody :key="pindextr" v-for="(ptr, pindextr) in data">
                    <vs-tr :state="'success'">
                        <template v-if="ptr.hasColspan == false">
                            <td>{{ ptr.name }}</td>
                            <td :key="index" v-for="(row, index) in ptr.values">{{ row }}</td>
                        </template>
                        <td v-else :colspan="ptr.colspan">{{ ptr.name }}</td>
                    </vs-tr>

                    <template v-if="ptr.children" v-for="(row, index) in ptr.children">

                        <vs-tr style="background: #b2ffd9">
                            <td></td>
                            <td>{{ row.name }}</td>
                            <td>{{ row.responsible_entity.name }}</td>
                            <td>{{ row.responsible_person.name }}</td>
                            <td>
                                <center><feather-icon style="cursor: pointer;" @click="openForm" icon="PlusIcon"
                                        svgClasses="w-5 h-5 hover:text-primary stroke-current" /></center>
                            </td>
                        </vs-tr>

                        <template v-if="row.children" v-for="row in row.children">

                            <vs-tr style="background-color: #f3edf5">
                                <td></td>
                                <td>{{ row.name }}</td>
                                <td>{{ row.responsible_entity.name }}</td>
                                <td>{{ row.responsible_person.name }}</td>
                                <td>
                                    <center><feather-icon style="cursor: pointer;" @click="openForm" icon="PlusIcon"
                                            svgClasses="w-5 h-5 hover:text-primary stroke-current" /></center>
                                </td>
                            </vs-tr>

                            <template v-if="row.children" v-for="row in row.children">
                                <vs-tr style="background-color: #fffde5">
                                    <td></td>
                                    <td>{{ row.name }}</td>
                                    <td>{{ row.responsible_entity.name }}</td>
                                    <td>{{ row.responsible_person.name }}</td>
                                    <td>
                                        <center><feather-icon style="cursor: pointer;" @click="openForm" icon="PlusIcon"
                                                svgClasses="w-5 h-5 hover:text-primary stroke-current" /></center>
                                    </td>
                                </vs-tr>

                                <template v-for="row in row.children">
                                    <vs-tr style="background-color: ">
                                        <td></td>
                                        <td>{{ row.name }}</td>
                                        <td>{{ row.responsible_entity.name }}</td>
                                        <td>{{ row.responsible_person.name }}</td>
                                        <td></td>
                                    </vs-tr>
                                </template>

                            </template>

                            <!-- <vs-tr :key="index" v-for="(row2, index) in row3.data">
                                <td>{{ row2.name }}</td>
                                <td :key="index3" v-for="(row, index3) in row2.values">{{ row }}</td>
                                <td></td>
                            </vs-tr> -->
                        </template>
                    </template>

                </tbody>
            </template>
        </vs-table>

        <vs-table v-if="dataTables.data && dataTables.data.length && dataAttributes.tableStyle == 5"
            :max-items="dataTables.limit" :data="dataTables.data" style="overflow: scroll">

            <template slot-scope="{data}">

                <vs-tr>
                    <vs-td :style="style(header)" :key="i" v-for="(header, i) in dataHeaders" :colspan="colspan(header)"
                        :rowspan="rowspan(header)">
                        <span v-if="header.label">
                            <center>{{ $t(header.label) }} </center>
                        </span>
                        <span v-else>
                            <center>{{ $t(header.label) }}</center>
                        </span>
                    </vs-td>
                </vs-tr>

                <vs-tr v-if="dataTables.dataHeaders" style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                    <vs-td :key="j" v-for="(header, j) in dataTables.dataHeaders" :colspan="colspan(header)"
                        :rowspan="rowspan(header)">{{ header.label }} </vs-td>
                </vs-tr>

                <vs-tr v-if="dataTables.dataSubHeaders"
                    style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                    <vs-td :key="k" v-for="(header, k) in dataTables.dataSubHeaders" :colspan="colspan(header)"
                        :rowspan="rowspan(header)"><small>{{ header.label }}</small></vs-td>
                </vs-tr>

                <tbody :key="pindextr" v-for="(ptr, pindextr) in data">

                    <vs-tr :state="'success'">
                        <template v-if="ptr.hasColspan == false">
                            <td>{{ ptr.name }}</td>
                            <td :key="index" v-for="(row, index) in ptr.values">{{ row }}</td>
                        </template>
                        <td v-else :colspan="ptr.colspan">{{ ptr.name }}</td>
                    </vs-tr>
                    <!-- Level 1 -->
                    <template v-if="ptr.children" v-for="(row, index) in ptr.children">

                        <vs-tr :state="'warning'">
                            <td>{{ row.name }}</td>
                            <td>{{ }}</td>
                            <td>{{ }}</td>
                            <td>{{ }}</td>
                            <td>{{ }}</td>
                            <td>{{ }}</td>
                            <td>{{ }}</td>
                            <td>{{ }}</td>
                            <td>
                                <center><feather-icon style="cursor: pointer;" @click="openForm" icon="PlusIcon"
                                        svgClasses="w-5 h-5 hover:text-primary stroke-current" /></center>
                            </td>
                        </vs-tr>

                        <!-- Indicator -->
                        <template v-for="indicator_row in row.indicators">
                            <vs-tr>
                                <td>{{ indicator_row.indicator }}</td>
                                <td>{{ indicator_row.code }}</td>
                                <td>{{ }}</td>
                                <td>{{ }}</td>
                                <td>{{ }}</td>
                                <td>{{ }}</td>
                                <td>{{ }}</td>
                                <td>{{ }}</td>
                                <td>

                                </td>
                            </vs-tr>
                        </template>

                        <!-- Level 2 -->
                        <template v-if="row.children" v-for="row in row.children">

                            <vs-tr :state="'danger'">
                                <td>{{ row.name }}</td>
                                <td>{{ }}</td>
                                <td>{{ }}</td>
                                <td>{{ }}</td>
                                <td>{{ }}</td>
                                <td>{{ }}</td>
                                <td>{{ }}</td>
                                <td>{{ }}</td>
                                <td>
                                    <center><feather-icon style="cursor: pointer;" @click="openForm" icon="PlusIcon"
                                            svgClasses="w-5 h-5 hover:text-primary stroke-current" /></center>
                                </td>
                            </vs-tr>

                            <!-- Indicator -->
                            <template v-for="indicator_row in row.indicators">
                                <vs-tr>
                                    <td>{{ indicator_row.indicator }}</td>
                                    <td>{{ indicator_row.code }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>

                                    </td>
                                </vs-tr>
                            </template>

                            <!-- Level 3 -->
                            <template v-if="row.children" v-for="row in row.children">
                                <vs-tr style="background-color: #fffde5">
                                    <td>{{ row.name }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>{{ }}</td>
                                    <td>
                                        <center><feather-icon style="cursor: pointer;" @click="openForm" icon="PlusIcon"
                                                svgClasses="w-5 h-5 hover:text-primary stroke-current" /></center>
                                    </td>
                                </vs-tr>

                                <!-- Level 4 -->
                                <template v-for="row in row.children">
                                    <vs-tr style="background-color: #fffde5">
                                        <td>{{ row.name }}</td>
                                        <td>{{ }}</td>
                                        <td>{{ }}</td>
                                        <td>{{ }}</td>
                                        <td>{{ }}</td>
                                        <td>{{ }}</td>
                                        <td>{{ }}</td>
                                        <td>{{ }}</td>
                                        <td>{{ }}</td>
                                        <td>{{ }}</td>
                                    </vs-tr>
                                </template>

                            </template>
                        </template>
                    </template>

                </tbody>
            </template>
        </vs-table>

        <vs-table v-if="dataTables.data && dataTables.data.length && dataAttributes.tableStyle == 6"
            :max-items="dataTables.limit" :data="dataTables.data" style="overflow: scroll">
            <template slot-scope="{data}">

                <vs-tr>
                    <vs-td :style="style(header)" :key="i" v-for="(header, i) in dataHeaders" :colspan="colspan(header)"
                        :rowspan="rowspan(header)">
                        <span v-if="header.label">
                            <center><span v-html="$t(header.label)"></span></center>
                        </span>
                        <span v-else>
                            <center><span v-html="$t(header.label)"></span></center>
                        </span>
                    </vs-td>
                </vs-tr>

                <vs-tr v-if="dataTables.dataHeaders" style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                    <vs-td :style="style(header)" :key="j" v-for="(header, j) in dataTables.dataHeaders"
                        :colspan="colspan(header)" :rowspan="rowspan(header)">{{ header.label }} </vs-td>
                </vs-tr>

                <vs-tr v-if="dataTables.dataSubHeaders"
                    style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                    <vs-td :key="k" v-for="(header, k) in dataTables.dataSubHeaders" :colspan="colspan(header)"
                        :rowspan="rowspan(header)"><small>{{ header.label }}</small></vs-td>
                </vs-tr>

                <tbody :key="pindextr" v-for="(ptr, pindextr) in data">

                    <vs-tr :key="cindex" v-for="(cusField, cindex) in dataTables.group_fields" style="color: #f00;">
                        <td :key="scindex" v-for="(scfield, scindex) in ptr[cusField]">
                            <center>{{ scfield }}</center>
                        </td>
                    </vs-tr>

                    <template v-for="parent in ptr.children">
                        <vs-tr>
                            <vs-td :key="sindex" v-for="(dataField, sindex) in dataTables.dataFillables">
                                <center>{{ parent[dataField] }} </center>
                            </vs-td>
                        </vs-tr>

                        <template v-for="child in parent.children">
                            <vs-tr>
                                <vs-td :key="sindex" v-for="(dataField, sindex) in dataTables.dataFillables">
                                    <center>{{ child[dataField] }} </center>
                                </vs-td>
                            </vs-tr>

                            <vs-tr :key="sindex" v-for="(schild, sindex) in child.children">
                                <vs-td :key="sindex" v-for="(dataField, sindex) in dataTables.dataFillables">
                                    <center>{{ schild[dataField] }} </center>
                                </vs-td>
                            </vs-tr>
                        </template>
                    </template>
                </tbody>
            </template>
        </vs-table>

        <vs-table v-if="dataTables.data && dataTables.data.length && dataAttributes.tableStyle == 7"
            :max-items="dataTables.limit" :data="dataTables.data" style="overflow: scroll">
            <template slot-scope="{data}">
                <vs-tr>
                    <vs-td :style="style(header)" :key="i" v-for="(header, i) in dataHeaders" :colspan="colspan(header)"
                        :rowspan="rowspan(header)">
                        <span v-if="header.label">
                            <center><span v-html="$t(header.label)"></span></center>
                        </span>
                        <span v-else>
                            <center><span v-html="$t(header.label)"></span></center>
                        </span>
                    </vs-td>
                </vs-tr>

                <vs-tr v-if="dataTables.dataHeaders" style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                    <vs-td :style="style(header)" :key="j" v-for="(header, j) in dataTables.dataHeaders"
                        :colspan="colspan(header)" :rowspan="rowspan(header)">{{ header.label }} </vs-td>
                </vs-tr>

                <vs-tr v-if="dataTables.dataSubHeaders"
                    style="background-color: #28C76F; color: #ffffff; font-weight: bold;">
                    <vs-td :key="k" v-for="(header, k) in dataTables.dataSubHeaders" :colspan="colspan(header)"
                        :rowspan="rowspan(header)"><small>{{ header.label }}</small></vs-td>
                </vs-tr>

                <tbody>
                    <template v-for="ptr in data">
                        <vs-tr :key="cindex" v-for="(cusField, cindex) in dataTables.group_fields" style="color: #f00;">
                            <td :key="scindex" v-for="(scfield, scindex) in ptr[cusField]">
                                <center>{{ scfield }}</center>
                            </td>
                        </vs-tr>
                    </template>

                    <template v-for="ptr in data">
                        <vs-tr>
                            <vs-td :key="sindex" v-for="(dataField, sindex) in dataTables.dataFillables">
                                <center>{{ ptr[dataField] }} </center>
                            </vs-td>
                        </vs-tr>

                        <vs-tr :key="sindex" v-for="(schild, sindex) in ptr.children">
                            <vs-td :key="sindex" v-for="(dataField, sindex) in dataTables.dataFillables">{{
                                schild[dataField] }}</vs-td>
                        </vs-tr>

                        <template v-for="sdata in ptr.data">
                            <vs-tr>
                                <vs-td :key="sindex" v-for="(dataField, sindex) in dataTables.dataFillables">{{
                                    sdata[dataField] }}</vs-td>
                            </vs-tr>
                            <vs-tr :key="sindex" v-for="(schild, sindex) in sdata.children">
                                <vs-td :key="sindex" v-for="(dataField, sindex) in dataTables.dataFillables">{{
                                    schild[dataField] }}</vs-td>
                            </vs-tr>
                        </template>
                    </template>
                </tbody>
            </template>
        </vs-table>

        <div class="my-5">
            <vs-pagination :total="calPaginNumber(dataTables.total / dataTables.limit)"
                v-model="current_page"></vs-pagination>
            <!-- <p class="mb-3">Current Page: {{ current_page }}</p>
            <vs-button @click="current_page++">Increment</vs-button>
            <vs-button class="ml-4 mb-4" @click="current_page--">Decrement</vs-button> -->
        </div>

    </vx-card>
</template>

<script>

import axios from "@/axios.js";
import DSearch from '@/views/form-builder/DSearch.vue';
import DModalForm from '@/views/form-builder/DModalForm.vue';
import DForm from '@/views/form-builder/DForm.vue'
import DFormElement from '@/views/form-builder/DFormElement.vue'
import DHeadingWizard from '@/views/form-builder/DHeadingWizard.vue';
import DChildTable from '@/views/form-builder/DChildTable.vue'
import { stringify } from 'querystring';
import { ref } from 'vue';
export default {
    props: {
        title: {
            type: String,
            required: true
        },
        dataAttributes: {
            required: true,
        },
        dataHeaders: {
            required: true,
        },
        dataTables: {
            required: true,
        },
        allowDel: {
            type: Boolean
        },
        api: { type: String },
        formAttributes: { required: true },
        rowDisplay: { type: String }
    },
    data() {
        return {
            titleStr: "",
            currentx: 0,
            current_page: 1,
            dataId: 0,
            // Remove Data Info Obj just for testing 
            dataInfo: {
                indicator: {
                    data: {

                    }
                }
            },
            enableToggleForm: true,
            dataElements: []
        }
    },
    components: {
        DSearch,
        DModalForm,
        DHeadingWizard,
        DForm,
        DFormElement,
        DChildTable
    },
    methods: {
        transformData(obj) {
            let _str = JSON.parse(obj);
            return _str;
        },
        getDocumentSize(obj) {
            return obj ? obj.length : 0;
        },
        style(obj) {
            if (obj.width) {
                return "background-color: #28C76F; color: #ffffff; font-weight: bold;min-width:" + obj.width + "px";
            } else {
                return "background-color: #28C76F; color: #ffffff; font-weight: bold;";
            }
        },
        colspan(obj) {
            let _val = "";
            if (obj.colspan) {
                _val = obj.colspan;
            }
            return _val;
        },
        rowspan(obj) {
            let _val = "";
            if (obj.rowspan) {
                _val = obj.rowspan;
            }
            return _val;
        },
        viewUrl(obj) {
            console.log(obj);
            this.$router.push(obj.path).catch(() => { });
        },
        initPushDataTable(obj) {
            this.dataElements = [];
            let _data = [
                {
                    id: 1,
                    name: "tests"
                },
                {
                    id: 2,
                    name: "test2"
                }
            ];
            _data.forEach(_obj => {
                this.dataElements.push(_obj);
            });
        },
        openForm() {
            this.$refs.refModalForm.openNewForm();
            this.$emit("emitDataForm", "test change form attribute");
        },
        openToggleForm() {
            this.enableToggleForm = true
        },
        openFormByParent(obj) {
            this.$refs.refModalForm.openNewFormByParent(obj);
        },
        calPaginNumber(n) {
            // alert(n);
            let _newVal = 0;
            if (Number(n) === n && n % 1 === 0) {
                _newVal = n;
            } else {
                _newVal = Math.floor(n + 1);
            }
            return _newVal;
        },
        calPageIncreaseNumber(_page_limit, index) {
            let _offset = (this.current_page - 1) * _page_limit;
            let _result = _offset + (index + 1);
            return _result;
        },
        initTableData() {
            let _search_params = {
                pageNum: this.current_page,
                searchFields: []
            }
            this.$emit('clicked', _search_params);
        },
        searchQuery(_search_fields) {
            let _search_params = {
                pageNum: this.current_page,
                searchFields: _search_fields
            }
            this.$emit('clicked', _search_params);
        },
        initDel(id) {
            this.dataId = id;
            this.$vs.dialog({
                type: 'confirm',
                color: 'danger',
                title: `Confirm`,
                text: 'តើអ្នកពិតជាចង់ធ្វើការលុបទិន្នន័យនេះជារៀងរហូត?',
                accept: this.acceptAlert
            })
        },
        acceptAlert() {
            let id = this.dataId;
            let _search_params = {
                pageNum: this.current_page,
                searchFields: []
            }
            return new Promise((resolve, reject) => {
                axios.delete(this.api + '/' + id)
                    .then((response) => {
                        this.$vs.notify({
                            title: 'Message',
                            text: response.data.message,
                            iconPack: 'feather',
                            icon: 'icon-check-circle',
                            color: 'primary',
                            position: 'top-right'
                        })
                        this.$emit('clicked', _search_params);
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
        },
        initEdit(data) {
            this.$refs.refModalForm.initForm(data);
        }

    },
    created() {
        // console.log("data table", this.dataTables)
        this.$vs.loading.close();
    },
    watch: {
        current_page: function (val) {
            let _search_params = {
                pageNum: this.current_page,
                searchFields: []
            }
            this.$emit('clicked', _search_params)
        }
    }
}
</script>

<style>
th.th-width-300 {
    min-width: 260px !important;
}

td.td-width-150 {
    min-width: 150px !important;
}

table tr td,
th {
    border: 1px solid #d7d7d7;
}

th {
    text-align: center !important;
    /* display: inline; */
}

th.rotate {
    transform: rotate(-90deg)
}

.vs-table--thead th .vs-table-text {
    text-transform: uppercase;
    font-weight: 600;
    text-align: center;
    display: inline !important;
}
</style>

<style lang="scss">
#data-list-list-view {
    font-family: 'Khmer MEF1';

    .vs-con-table {

        /*
        Below media-queries is fix for responsiveness of action buttons
        Note: If you change action buttons or layout of this page, Please remove below style
        */
        @media (max-width: 689px) {
            .vs-table--search {
                margin-left: 0;
                max-width: unset;
                width: 100%;

                .vs-table--search-input {
                    width: 100%;
                }
            }
        }

        @media (max-width: 461px) {
            .items-per-page-handler {
                display: none;
            }
        }

        @media (max-width: 341px) {
            .data-list-btn-container {
                width: 100%;

                .dd-actions,
                .btn-add-new {
                    width: 100%;
                    margin-right: 0 !important;
                }
            }
        }

        .product-name {
            max-width: 23rem;
        }

        .vs-table--header {
            display: flex;
            flex-wrap: wrap;
            margin-left: 1.5rem;
            margin-right: 1.5rem;

            >span {
                display: flex;
                flex-grow: 1;
            }

            .vs-table--search {
                padding-top: 0;

                .vs-table--search-input {
                    padding: 0.9rem 2.5rem;
                    font-size: 1rem;

                    &+i {
                        left: 1rem;
                    }

                    &:focus+i {
                        left: 1rem;
                    }
                }
            }
        }

        .vs-table {
            border-collapse: separate;
            border-spacing: 0 1.3rem;
            padding: 0 1rem;

            tr {
                box-shadow: 0 4px 20px 0 rgba(0, 0, 0, .05);

                td {
                    padding: 20px;

                    &:first-child {
                        border-top-left-radius: .5rem;
                        border-bottom-left-radius: .5rem;
                    }

                    &:last-child {
                        border-top-right-radius: .5rem;
                        border-bottom-right-radius: .5rem;
                    }
                }

                td.td-check {
                    padding: 20px !important;
                }
            }
        }

        .vs-table--thead {
            th {
                padding-top: 0;
                padding-bottom: 0;

                .vs-table-text {
                    text-transform: uppercase;
                    font-weight: 600;
                }
            }

            th.td-check {
                padding: 0 15px !important;
            }

            tr {
                background: none;
                box-shadow: none;
            }
        }

        .vs-table--pagination {
            justify-content: center;
        }
    }
}
</style>

