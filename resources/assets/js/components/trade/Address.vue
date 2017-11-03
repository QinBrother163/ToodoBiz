<template>
    <el-form :model="form">
        <el-form-item label="收货人姓名">
            <el-input v-model="form.name"></el-input>
        </el-form-item>
        <el-form-item label="收货人手机号码">
            <el-input v-model="form.phone"></el-input>
        </el-form-item>
        <el-form-item label="详细收货地址">
            <el-input v-model="form.address"></el-input>
        </el-form-item>
        <el-form-item label="是否工作日收货">
            <el-radio-group v-model="form.workday">
                <el-radio :label="1">是</el-radio>
                <el-radio :label="0">否</el-radio>
            </el-radio-group>
        </el-form-item>
        <el-form-item>
            <el-button @click="confirm">下一步</el-button>
        </el-form-item>
    </el-form>
</template>

<script>
    export default {
        props: ['userId', 'retailId'],
        data(){
            return {
                form: {
                    name: '',
                    phone: '',
                    address: '',
                    workday: 1,
                }
            };
        },
        mounted() {
            console.log('Component mounted.')
        },
        methods: {
            confirm(){

            },
            submitForm(formName) {
                this.$refs[formName].validate((valid) => {
                    if (valid) {
                        alert('submit!');
                    } else {
                        console.log('error submit!!');
                        return false;
                    }
                });
            },
            resetForm(formName) {
                this.$refs[formName].resetFields();
            }
        }
    }
</script>
