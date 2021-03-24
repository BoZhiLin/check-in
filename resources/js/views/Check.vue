<template>
  <Layout>
    <div class="row justify-content-center">
      <b-col md="3">
        <b-card
          align="center"
          header="上/下班打卡"
          header-text-variant="white"
          header-tag="header"
          header-bg-variant="dark"
          :footer="todayRecord ? '' : '本日尚未打卡'"
          footer-tag="footer"
          footer-bg-variant="success"
          footer-border-variant="dark"
        >
          <b-form onsubmit="return false;">
            <b-input-group size="md" prepend="上班時間">
              <vue-timepicker format="HH:mm:ss" v-model="time"></vue-timepicker>
              <!-- <datetime
                style="flex: 1 1 auto;"
                type="datetime"
                class="input-group-prepend"
                input-class="form-control"
                :phrases="{ ok: '確定', cancel: '取消' }"
                format="yyyy/MM/dd HH:mm:ss"
                auto
              ></datetime> -->
            </b-input-group>
          </b-form>
          <b-card-text>Header and footers variants.</b-card-text>
        </b-card>
      </b-col>
    </div>
  </Layout>
</template>

<script>
import api from "../tools/api.js";
import defined from "../tools/defined.js";

import Layout from "../components/Layout";

export default {
  components: {
    Layout,
  },
  data() {
    return {
      todayRecord: {},
      time: "",
    };
  },
  created() {
    this.getUserRecord();
    let date = new Date();
    this.time = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
    this.checkIn();
  },
  methods: {
    checkIn() {
      api.checkIn({
          time: this.time  
        })
        .then(({ data }) => {
          console.log(data);
        });
    },
    getUserRecord() {
      api.getUserRecord()
        .then((response) => {
          const { status, data } = response.data;

          if (status === defined.response.SUCCESS) {
            this.todayRecord = data.record;
          }
        })
    }
  },
  computed: {

  }
};
</script>

<style lang="scss" scoped>

</style>
