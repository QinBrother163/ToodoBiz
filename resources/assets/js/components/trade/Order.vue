<template>
    <div>
        <el-row>
            <el-col :span="5">
                <el-date-picker
                        @change="handleDateRangeChange"
                        v-model="dateRange"
                        type="daterange"
                        align="right"
                        placeholder="选择日期范围"
                        :picker-options="pickerOptions">
                </el-date-picker>
            </el-col>
            <el-col :span="19">
                <el-col :span="4" style='display: none'>
                    <el-autocomplete
                            class="inline-input"
                            v-model="amount"
                            :fetch-suggestions="querySearch"
                            custom-item="my-item-zh"
                            placeholder="请输入金额"
                            @select="handleAmountSelect">
                        <template slot="prepend">金额</template>
                    </el-autocomplete>
                </el-col>
                <el-col :span="4"  style='display: none'>
                    <el-select v-model="orderStatus" placeholder="订单状态">
                        <el-option label="全部状态" value="0"></el-option>
                        <el-option label="未发货" value="1"></el-option>
                        <el-option label="已发货" value="2"></el-option>
                    </el-select>
                </el-col>
                <el-col :span="7"  style='display: none'>
                    <el-input v-model="value" placeholder="请输入搜索内容" @change="handleNumberSelect_import" >
                        <el-select v-model="key" slot="prepend" placeholder="请选择" @change="handleNumberSelect_options" style="width: 110px">
                            <el-option label="用户编号" value="UserId"></el-option>
                            <el-option label="订单号" value="OrderNo"></el-option>
                        </el-select>
                    </el-input>
                </el-col>
                <el-col :span="3"  style='display: none'>
                    <el-button type="primary" icon="search" @click="handleSearchClick">搜索</el-button>
                </el-col>
                <el-button type="button" @click="screening = true">筛选</el-button>
                <el-dialog title="套餐类型：" :visible.sync="screening" :modal="false" :close-on-click-modal="false" :show-close="false">
                    <el-checkbox-group v-model="check_List" @change="handleCurrentChangeAmount">
                        <el-checkbox label="包月">包月</el-checkbox>
                        <el-checkbox label="套餐一">套餐一</el-checkbox>
                        <el-checkbox label="套餐二">套餐二</el-checkbox>
                        <el-checkbox label="黄金套餐">黄金套餐</el-checkbox>
                        <el-checkbox label="钻石套餐">钻石套餐</el-checkbox>
                    </el-checkbox-group>
                    <span style="margin: 20px 0 30px 0;display: block" class="el-dialog__title">订单状态：</span>
                    <el-radio-group v-model="state_order" @change="handleCurrentChangeOrderStatus">
                        <el-radio :label="5">已订购</el-radio>
                        <el-radio :label="1">未订购</el-radio>
                        <el-radio :label="10">不限</el-radio>
                    </el-radio-group>
                    <span style="margin: 20px 0 30px 0;display: block" class="el-dialog__title">注册用户：</span>
                    <el-checkbox-group v-model="register_user" @change="handleCurrentRegisterUser">
                        <el-checkbox label="UserId">注册用户</el-checkbox>
                    </el-checkbox-group>
                    <div slot="footer" class="dialog-footer">
                        <el-button @click="cancelSearchCondition">取 消</el-button>
                        <el-button type="primary" @click="handleSearchClick">确 定</el-button>
                    </div>
                </el-dialog>
            </el-col>
        </el-row>
            <div id='selected_condition_style' class="selected_condition_style">
                <span>已选择的条件 ：</span>
                <a href='javascript:'><span>{{amount_0}}</span></a>
                <a href='javascript:'><span>{{amount_1}}</span></a>
                <a href='javascript:'><span>{{amount_2}}</span></a>
                <a href='javascript:'><span>{{amount_3}}</span></a>
                <a href='javascript:'><span>{{amount_4}}</span></a>
                <a href='javascript:'><span>{{showOrderStatus}}</span></a>
            </div>
        <el-row>

        </el-row>

        <el-pagination
                @size-change="handleSizeChange"
                @current-change="handleCurrentChange"
                :current-page="current_page"
                :page-sizes="[15, 30, 45, 60]"
                :page-size="per_page"
                layout="total, sizes, prev, pager, next, jumper"
                :total="total">
        </el-pagination>


        <el-table id='tdo_order_datas'
                v-if="data.length > 0"
                :data="data"
                style="width: 100%;display: block;text-align: center">
            <el-table-column
                    prop="OrderNo"
                    label="订单号"
                    header-align='center'
                    width="208">
            </el-table-column>
            <el-table-column
                    prop="ShopId"
                    label="渠道"
                    header-align='center'
                    width="70">
            </el-table-column>
            <el-table-column
                    prop="UserId"
                    label="用户"
                    header-align='center'
                    width="100">
            </el-table-column>
            <el-table-column
                    prop="Signature"
                    label="标题"
                    header-align='center'
                    width="450">
            </el-table-column>
            <el-table-column
                    prop="Amount"
                    label="金额"
                    header-align='center'
                    width="150">
            </el-table-column>
            <el-table-column
                    prop="PayStatus"
                    label="状态"
                    header-align='center'
                    width="100">
            </el-table-column>
            <el-table-column
                    prop="CreateDate"
                    label="创建时间"
                    header-align='center'
                    width="200">
            </el-table-column>
            <el-table-column
                    prop="DeviceId"
                    label="电话"
                    header-align='center'
                    width="200">
            </el-table-column>
            <el-table-column label="操作">
                <template scope="scope">
                    <el-button v-if="scope.row.tradeStatus==2&&scope.row.retailId!=1000" size="mini" @click="handleEdit(scope.$index, scope.row)" :plain="true" type="success">确定发货</el-button>
                    <el-button v-if="scope.row.tradeStatus==3" size="mini" @click="handleEdit(scope.$index, scope.row)" :plain="true" type="danger">退货操作</el-button>
                </template>
            </el-table-column>
        </el-table>
        <el-table id='tdo_edouser_datas'
                        v-if="data.length > 0"
                        :data="data"
                        style="width: 100%;display: none;text-align: center">
                    <el-table-column
                            prop="UserId"
                            label="用户"
                            header-align='center'
                            width="108">
                    </el-table-column>
                    <el-table-column
                            prop="NickName"
                            label="全家e动用户"
                            header-align='center'
                            width="170">
                    </el-table-column>
                    <el-table-column
                            prop="PassportId"
                            label="护照身份证"
                            header-align='center'
                            width="150">
                    </el-table-column>
                    <el-table-column
                            prop="bizContent"
                            label="商务内容"
                            header-align='center'
                            width="350">
                    </el-table-column>
                    <el-table-column
                            prop="RetailId"
                            label="零售编号"
                            header-align='center'
                            width="150">
                    </el-table-column>
                    <el-table-column
                            prop="buyHand"
                            label="买手"
                            header-align='center'
                            width="100">
                    </el-table-column>
                    <el-table-column
                            prop="vipGrade"
                            label="贵宾等级"
                            header-align='center'
                            width="200">
                    </el-table-column>
                    <el-table-column
                            prop="bizUser.address"
                            label="地址"
                            header-align='center'
                            width="200">
                    </el-table-column>
                    <el-table-column label="操作">
                        <template scope="scope">
                            <el-button v-if="scope.row.tradeStatus==2&&scope.row.retailId!=1000" size="mini" @click="handleEdit(scope.$index, scope.row)" :plain="true" type="success">确定发货</el-button>
                            <el-button v-if="scope.row.tradeStatus==3" size="mini" @click="handleEdit(scope.$index, scope.row)" :plain="true" type="danger">退货操作</el-button>
                        </template>
                    </el-table-column>
                </el-table>
                <el-row id="echarts">
                    <div id="main" style="width: 1730px;height:800px;"></div>
                </el-row>
    </div>
</template>

<style>
    /*.el-select {*/
    /*width: 128px;*/
    /*}*/
</style>

<script>
    Vue.component('my-item-zh', {
        functional: true,
        render: function (h, ctx) {
            var item = ctx.props.item;
            console.log(ctx);
            return h('li', ctx.data, [
                h('div', {attrs: {class: 'name'}}, [item.name]),
                //h('span', { attrs: { class: 'addr' } }, [item.amount])
            ]);
        },
        props: {
            item: {type: Object, required: true}
        }
    });

    import {pageUrl} from '../../app/PageUrl';

    export default {
        data() {
            return {
                total: 50,
                per_page: 15,
                current_page: 1,
                last_page: 4,
                next_page_url: "",
                prev_page_url: null,
                from: 1,
                to: 15,
                data: [],


                pickerOptions: {
                    shortcuts: [{
                        text: '最近一周',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            start.setTime(start.getTime() - 3600 * 1000 * 24 * 7);
                            picker.$emit('pick', [start, end]);
                        }
                    }, {
                        text: '最近一个月',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            start.setTime(start.getTime() - 3600 * 1000 * 24 * 30);
                            picker.$emit('pick', [start, end]);
                        }
                    }, {
                        text: '最近三个月',
                        onClick(picker) {
                            const end = new Date();
                            const start = new Date();
                            start.setTime(start.getTime() - 3600 * 1000 * 24 * 90);
                            picker.$emit('pick', [start, end]);
                        }
                    }]
                },
                screening: false,
                check_List: [],
                state_order: 10,
                amount_list: [],
                register_user: [],
                order_status: '',

                dateRange: '',
                amounts: [],
                amount: '',
                orderStatus: '',
                key: '',
                value: '',
                options: '',
                import: '',
                amount_list_args: '',
                order_status_args: '',
                amount_0: '',
                amount_1: '',
                amount_2: '',
                amount_3: '',
                amount_4: '',
                showOrderStatus: '',
                registerUser: '',
                chart_date: [],
                chart_val0: [],
                chart_val1: [],
                chart_val2: [],
                chart_val3: [],
                chart_val4: [],
                chart_paginate1: '',
                chart_paginate2: '',
                chart_paginate3: '',
                chart_paginate4: '',
                chart_paginate5: '',
            };
        },
        mounted() {
            this.setAmounts();
            this.getOrders();
        },
        methods: {
            handleEdit(index, row) {
                //console.log(index, row);
            },
            handleDelete(index, row) {
                //console.log(index, row);
            },
            handleSizeChange(val) {    //val  ---  当前显示15条数据
                if (this.per_page == val) return;
                if (this.per_page < val) {
                    this.last_page = parseInt(this.total / val);       //解析字符串转化整数
                    if (this.total % val) this.last_page++;

                    if (this.current_page > this.last_page) {
                        this.current_page = this.last_page;
                    }
                }
                this.per_page = val;
                this.getOrders();
            },
            handleCurrentChange(val) {
                if (this.current_page == val)return;
                this.current_page = val;
                this.getOrders();
            },
            handleDateRangeChange(val){
                if (this.dateRange == val)return;
                this.getOrders();
            },
            //===================================================
            setAmounts(){
                this.amounts = [
                    {'value': '2500', 'name': '包月'},
                    {'value': '22900', 'name': '套餐一'},
                    {'value': '13900', 'name': '套餐二'},
                    {'value': '19900', 'name': '黄金套餐'},
                    {'value': '28900', 'name': '钻石套餐'},
                ];
            },
            querySearch(query, cb) {
                let amounts = this.amounts;
                let results = query ? amounts.filter(this.createFilter(query)) : amounts;
                // 调用 callback 返回建议列表的数据
                cb(results);
            },
            createFilter(query) {
                return (str) => {
                    //return (str.value.indexOf(query.toLowerCase()) === 0);
                    return true;
                };
            },
            handleAmountSelect(item) {
                //console.log(item);
            },

            handleNumberSelect_import(val) {
                //console.log(val);
                this.import = val;
            },
            handleNumberSelect_options(val) {
                //console.log(val);
                this.options = val;
            },
            handleCurrentChangeAmount(val) {
                this.amount_0 = val[0];
                this.amount_1 = val[1];
                this.amount_2 = val[2];
                this.amount_3 = val[3];
                this.amount_4 = val[4];
                this.amount_list = val;
                let owner = this;
                let selected_condition_style = document.getElementById('selected_condition_style');
                let a = selected_condition_style.querySelectorAll('a');
                let tdo_edouser_datas = document.getElementById('tdo_edouser_datas');
                let tdo_order_datas = document.getElementById('tdo_order_datas');

                for (let i=0;i<a.length;i++){
                    a[i].onclick = function(){
                        if(owner.amount_list[i] == this.innerText){
                            owner.amount_list.splice(i,1);
                            owner.amount_0 = val[0];
                            owner.amount_1 = val[1];
                            owner.amount_2 = val[2];
                            owner.amount_3 = val[3];
                            owner.amount_4 = val[4];
                            owner.getOrders();
                        }
                    }
                }
                tdo_order_datas.style.display = 'block';
                tdo_edouser_datas.style.display = 'none';
            },
            handleCurrentChangeOrderStatus(val) {

                if (val == 5) {
                this.showOrderStatus = '已订购';
                }else if (val == 1) {
                this.showOrderStatus = '未订购';
                }else if (val == 10) {
                this.showOrderStatus = '不限';
                }

                this.order_status = val;
                //console.log(val);
            },
            handleCurrentRegisterUser(val){
                this.registerUser = val;
                //console.log(val);
                let tdo_edouser_datas = document.getElementById('tdo_edouser_datas');
                let tdo_order_datas = document.getElementById('tdo_order_datas');

                tdo_order_datas.style.display = 'none';
                tdo_edouser_datas.style.display = 'block';
            },
            //===================================================
            handleSearchClick(){
                //console.log('amount:' + this.amount + ' status:' + this.orderStatus);
                //console.log(this.key + ':' + this.value);// 1:abc
                this.getOrders();
                this.screening = false;
            },
            cancelSearchCondition(){
                //this.amount_0 = '';
                //this.amount_1 = '';
                //this.amount_2 = '';
                //this.amount_3 = '';
                //this.amount_4 = '';
                //this.showOrderStatus = '';
                this.screening = false;
            },

            getOrders(){
                let owner = this;
                const baseUrl = 'toodo/trade/order?';
                let args = {};                            //  args 里面有两个属性 - page  - size
                if (this.current_page) {
                    args.page = this.current_page;
                }
                if (this.per_page) {
                    args.size = this.per_page;
                }
                if (this.dateRange) {
                    let range = ('' + this.dateRange).split(',');
                    if (range.length == 2) {

                        let date_0 = new Date(range[0]);
                        let date_1 = new Date(range[1]);

                        args.begin = date_0.getFullYear() + '-' + (date_0.getMonth() + 1) + '-' + date_0.getDate();
                        args.end = date_1.getFullYear() + '-' + (date_1.getMonth() + 1) + '-' + date_1.getDate();
                    }
                }
                if (this.amount) {
                    args.amount = this.amount;
                }
                if (this.key && this.value) {
                    args.key = this.key;  //      当前 下标 按钮
                    args.value = this.value;  //    当前  下标 value
                }
                if (this.options && this.import) {
                    args.import = this.import;
                    args.options = this.options;
                }
                if (this.amount_list) {

                     let arr_1 ,arr_2;
                     let arr_list = [];
                     arr_1 = this.amount_list;

                     let amount_2500 = '2500';
                     let amount_22900 = '22900';
                     let amount_13900 = '13900';
                     let amount_19900 = '19900';
                     let amount_28900 = '28900';

                     if (arr_1[0] == '包月') {
                         arr_list[0] = amount_2500;
                     }else if (arr_1[0] == '套餐一') {
                         arr_list[0] = amount_22900;
                     }else if (arr_1[0] == '套餐二') {
                         arr_list[0] = amount_13900;
                     }else if (arr_1[0] == '黄金套餐') {
                         arr_list[0] = amount_19900;
                     }else if (arr_1[0] == '钻石套餐') {
                         arr_list[0] = amount_28900;
                     }else if (!arr_1[0]) {
                          arr_list[0]= '';
                     }

                     if (arr_1[1] == '包月') {
                         arr_list[1] = amount_2500;
                     }else if (arr_1[1] == '套餐一') {
                         arr_list[1] = amount_22900;
                     }else if (arr_1[1] == '套餐二') {
                         arr_list[1] = amount_13900;
                     }else if (arr_1[1] == '黄金套餐') {
                         arr_list[1] = amount_19900;
                     }else if (arr_1[1] == '钻石套餐') {
                         arr_list[1] = amount_28900;
                     }else if (!arr_1[1]) {
                         arr_list[1]= '';
                     }

                     if (arr_1[2] == '包月') {
                         arr_list[2] = amount_2500;
                     }else if (arr_1[2] == '套餐一') {
                         arr_list[2] = amount_22900;
                     }else if (arr_1[2] == '套餐二') {
                         arr_list[2] = amount_13900;
                    }else if (arr_1[2] == '黄金套餐') {
                         arr_list[2] = amount_19900;
                     }else if (arr_1[2] == '钻石套餐') {
                         arr_list[0] = amount_28900;
                     }else if (!arr_1[2]) {
                     arr_list[2]= '';
                     }

                     if (arr_1[3] == '包月') {
                         arr_list[3] = amount_2500;
                     }else if (arr_1[3] == '套餐一') {
                         arr_list[3] = amount_22900;
                     }else if (arr_1[3] == '套餐二') {
                         arr_list[3] = amount_13900;
                     }else if (arr_1[3] == '黄金套餐') {
                         arr_list[3] = amount_19900;
                     }else if (arr_1[3] == '钻石套餐') {
                         arr_list[3] = amount_28900;
                     }else if (!arr_1[3]) {
                         arr_list[3]= '';
                     }

                     if (arr_1[4] == '包月') {
                         arr_list[4] = amount_2500;
                     }else if (arr_1[4] == '套餐一') {
                         arr_list[4] = amount_22900;
                     }else if (arr_1[4] == '套餐二') {
                         arr_list[4] = amount_13900;
                     }else if (arr_1[4] == '黄金套餐') {
                         arr_list[4] = amount_19900;
                     }else if (arr_1[4] == '钻石套餐') {
                         arr_list[4] = amount_28900;
                     }else if (!arr_1[4]) {
                         arr_list[4]= '';
                     }

                    arr_2 = arr_list.join(" ");
                    args.amount_list_arge = arr_2;
                }

                if (this.order_status) {
                    args.order_status_args = this.order_status;
                    //console.log(args.order_status_args);
                }else {
                    args.order_status_args = 10;
                }
                if (this.registerUser){
                    args.registerUserArgs = this.registerUser;
                    //console.log(args.registerUserArgs);
                }

                const reqUrl = baseUrl + pageUrl.parseArgs(args);
                console.log(reqUrl);

                let echarts = require('echarts');
                let myChart = echarts.init(document.getElementById('main'));

                let option = {
                    title: {
                        text: '用户付费数据'
                    },
                    tooltip: {
                        trigger: 'axis'
                    },
                    legend: {
                        data: []
                    },
                    grid: {
                        left: '3%',
                        right: '4%',
                        bottom: '3%',
                        containLabel: true
                        },
                    toolbox: {
                        feature: {
                            saveAsImage: {}
                        }
                    },

                    xAxis: {
                        type: 'category',
                        boundaryGap: false,
                        data: [],
                        axisLabel:{
                            interval:0,//横轴信息全部显示
                            rotate:-30,//-30度角倾斜显示
                        }
                    },
                     yAxis: {
                        type: 'value'
                    },
                    series: [
                        {
                            name: '',
                            type: 'line',
                            stack: '总量',
                            itemStyle : { normal: {label : {show: true}}},
                            data: ''
                        },
                        {
                            name: '',
                            type: 'line',
                            stack: '总量',
                            itemStyle : { normal: {label : {show: true}}},
                            data: ''
                        },
                        {
                            name: '',
                            type: 'line',
                            stack: '总量',
                            itemStyle : { normal: {label : {show: true}}},
                            data: ''
                        },
                        {
                            name: '',
                            type: 'line',
                            stack: '总量',
                            itemStyle : { normal: {label : {show: true}}},
                            data: ''
                        },
                        {
                            name: '',
                            type: 'line',
                            stack: '总量',
                            itemStyle : { normal: {label : {show: true}}},
                            data: ''
                        }
                    ]
                };
                myChart.setOption(option);

                axios.get(reqUrl)
                    .then(response => {

                        let paginate = response.data;
                        this.chart_paginate1 = paginate[1];
                        this.chart_paginate2 = paginate[2];
                        this.chart_paginate3 = paginate[3];
                        this.chart_paginate4 = paginate[4];
                        this.chart_paginate5 = paginate[5];
                        console.log(paginate.length);

                        setTimeout(function(){

                            option.series[0].name = owner.amount_list[0];
                            option.series[1].name = owner.amount_list[1];
                            option.series[2].name = owner.amount_list[2];
                            option.series[3].name = owner.amount_list[3];
                            option.series[4].name = owner.amount_list[4];

                            let option_data1 = [];
                            let option_data2 = [];
                            let option_data3 = [];
                            let option_data4 = [];
                            let option_data5 = [];
                            let option_date = [];

                            if(owner.chart_paginate1){
                                for(let i=0; i<owner.chart_paginate1.length;i++){
                                    option_data1.push(owner.chart_paginate1[i].val);
                                    option_date.push(owner.chart_paginate1[i].date);
                                }
                                option.series[0].data = option_data1;
                            }

                            if(owner.chart_paginate2){
                                for(let i=0; i<owner.chart_paginate2.length;i++){
                                    option_data2.push(owner.chart_paginate2[i].val);
                                    option_date.push(owner.chart_paginate2[i].date);
                                }
                                option.series[1].data = option_data2;
                            }

                            if(owner.chart_paginate3){
                                for(let i=0; i<owner.chart_paginate3.length;i++){
                                    option_data3.push(owner.chart_paginate3[i].val);
                                    option_date.push(owner.chart_paginate3[i].date);
                                }
                                option.series[2].data = option_data3;
                            }

                            if(owner.chart_paginate4){
                                for(let i=0; i<owner.chart_paginate4.length;i++){
                                    option_data4.push(owner.chart_paginate4[i].val);
                                    option_date.push(owner.chart_paginate4[i].date);
                                }
                                option.series[3].data = option_data4;
                            }

                            if(owner.chart_paginate5){
                                for(let i=0; i<owner.chart_paginate5.length;i++){
                                    option_data5.push(owner.chart_paginate5[i].val);
                                    option_date.push(owner.chart_paginate5[i].date);
                                }
                                option.series[4].data = option_data5;
                            }

                            let result = [];
                            for (let i=0;i<option_date.length;i++){
                                if(result.indexOf(option_date[i])==-1){
                                    result.push(option_date[i])
                                }
                            }

                            console.log(result);
                            //option.xAxis.data = option_date;
                            option.xAxis.data = result;
                            myChart.clear();
                            myChart.setOption(option,true);
                        },470)

                        this.total = paginate[0].total;//          总数据
                        this.per_page = parseInt(paginate[0].per_page);  // 当前 显示的 条数
                        this.current_page = paginate[0].current_page; //   当前 下标 页
                        this.last_page = paginate[0].last_page;//    当前 显示的条数 的总页数
                        this.data = paginate[0].data;

                        if (paginate[0].total) {
                            this.next_page_url = paginate[0].next_page_url;
                            this.prev_page_url = paginate[0].prev_page_url;

                            this.from = paginate[0].from;
                            this.to = paginate[0].to;
                            if (this.current_page > this.last_page) {
                                this.current_page = this.last_page;
                            }
                        }
                    });
            },
        }
    }
</script>
