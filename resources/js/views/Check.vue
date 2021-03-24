<template>
  <Layout>
    <b-row align="center">
      <b-col xl="3"></b-col>
      <b-col xl="6">
        <b-card
          align="center"
          header="上/下班打卡"
          header-text-variant="white"
          header-tag="header"
          header-bg-variant="dark"
          :footer="card.footer_text"
          footer-tag="footer"
          :footer-bg-variant="card.footer_bg"
          footer-border-variant="dark"
        >
          <b-form @submit.stop.prevent>
            <div class="check-group">
              <label>上班時間：</label>
              <vue-timepicker format="HH:mm:ss" v-model="started_time" v-if="!today_record"></vue-timepicker>
              <span v-else>{{ today_record.started_time }}</span>
            </div>

            <div class="check-group" v-if="today_record">
              <label>下班時間：</label>
              <vue-timepicker format="HH:mm:ss" v-model="ended_time" v-if="!today_record.ended_time"></vue-timepicker>
              <span v-else>{{ today_record.ended_time }}</span>
            </div>

            <div class="check-group" v-if="today_record">
              <label>單日工時：</label>
              <span>{{ today_record.duration_time }}</span>
            </div>

            <div class="check-group">
              <b-button variant="primary" v-if="!today_record" @click="checkIn">上班打卡</b-button>
              <b-button variant="danger" v-else-if="today_record && !today_record.ended_time" @click="checkOut">下班打卡</b-button>
            </div>
            <!-- <datetime
              style="flex: 1 1 auto;"
              type="datetime"
              class="input-group-prepend"
              input-class="form-control"
              :phrases="{ ok: '確定', cancel: '取消' }"
              format="yyyy/MM/dd HH:mm:ss"
              auto
            ></datetime> -->
          </b-form>
          <b-card-text>
            
          </b-card-text>
        </b-card>
      </b-col>
      <b-col xl="3"></b-col>
    </b-row>
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
      today_record: {},
      started_time: "",
      ended_time: "",

      card: {
        footer_text: "本日尚未打卡",
        footer_bg: "success",
      }
    };
  },
  created() {
    this.getCheckRecords();
  },
  methods: {
    checkIn() {
      api.checkIn({
          started_time: this.started_time  
        })
        .then(({ data }) => {
          if (data.status === defined.response.SUCCESS) {
            this.getCheckRecords();
            this.$swal({
              type: "success",
              title: "上班",
              confirmButtonText: "確定"
            });
          }
          
        });
    },
    checkOut() {
      api.checkOut({
          ended_time: this.ended_time  
        })
        .then(({ data }) => {
          if (data.status === defined.response.SUCCESS) {
            this.getCheckRecords();
            this.$swal({
              type: "success",
              title: "下班",
              confirmButtonText: "確定"
            });
          }
        });
    },
    getCheckRecords() {
      api.getCheckRecords()
        .then((response) => {
          const { status, data } = response.data;

          if (status === defined.response.SUCCESS) {
            this.today_record = data.records[0];
            let date = new Date();

            if (this.today_record) {
              if (this.today_record.ended_time) {
                this.card.footer_text = "已下班";
                this.card.footer_bg = "danger";
              } else {
                this.card.footer_text = "上班中";
                this.card.footer_bg = "info";
                this.ended_time = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
              }
            } else {
              this.card.footer_text = "尚未打卡";
              this.card.footer_bg = "secondary";
              this.started_time = date.getHours() + ":" + date.getMinutes() + ":" + date.getSeconds();
            }
          }
        })
    }
  },
};
</script>

<style lang="scss" scoped>
.check-group {
  padding: 5px;
}
</style>
