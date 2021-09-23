<template>
  <form @submit="checkForm()">
    <div>

<p v-if="errors.length">
    <b>Please correct the following error(s):</b>
    <ul>
        <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
    </ul>
  </p>


      <h3>Pamatdati</h3>
      <div>
        <label>Vārds</label>
        <input type="text" v-model="basicData.name" />
      </div>
      <div>
        <label>Uzvārds</label>
        <input type="text" v-model="basicData.surname" />
      </div>
      <div>
        <label>Tālrunis</label>
        <input type="text" v-model="basicData.phone" />
      </div>
      <div>
        <label>epasts</label>
        <input type="email" v-model="basicData.email" />
      </div>
    </div>
    <div>
      <h3>Adrese</h3>
      <div>
        <label>Valsts</label>
        <input type="text" v-model="address.country" />
      </div>
      <div>
        <label>Pilsēta</label>
        <input type="text" v-model="address.city" />
      </div>
      <div>
        <label>Iela</label>
        <input type="text" v-model="address.street" />
      </div>
      <div>
        <label>Numurs</label>
        <input type="text" v-model="address.houseNumber" />
      </div>
      <div>
        <label>Indeks</label>
        <input type="text" v-model="address.postIndex" />
      </div>
    </div>

    <div>
      <h3>Izglītība</h3>
      <div v-for="(education, index) in educations" :key="index">
        <div>
          <label>Iestāde</label>
          <input type="text" v-model="education.institution" />
        </div>
        <div>
          <label>Virziens</label>
          <input type="text" v-model="education.faculty" />
        </div>
        <div>
          <label>Izglītības līmenis</label>
          <input type="text" v-model="education.level" />
        </div>
        <div>
          <label>Statuss</label>
          <select v-model="education.statuss">
            <option disabled value="">Izvēlaties vienu</option>
            <option>mācības pabeigtas</option>
            <option>pārtrauktas</option>
            <option>mācos</option>
          </select>
        </div>
        <div>
          <label>Laika posms</label>
          <input type="text" v-model="education.time" />
        </div>
        <font-awesome-icon
          :icon="addIcon"
          @click="addEducation(index)"
          v-show="index == educations.length - 1"
        />
        <font-awesome-icon
          :icon="removeIcon"
          @click="removeEducation(index)"
          v-show="index || (!index && educations.length > 1)"
        />
      </div>
    </div>

    <div>
      <h3>Darba pieredze</h3>
      <div v-for="(employment, index) in employments" :key="index">
        <div>
          <label>Iestāde</label>
          <input type="text" v-model="employment.institution" />
        </div>
        <div>
          <label>Amats</label>
          <input type="text" v-model="employment.position" />
        </div>
        <div>
          <label>Laika posms</label>
          <input type="text" v-model="employment.time" />
        </div>
        <div>
          <label>Darba apraksts</label>
          <input type="text" v-model="employment.description" />
        </div>
        <div>
          <label>Sasniegumi</label>
          <input type="text" v-model="employment.achievements" />
        </div>

        <font-awesome-icon
          :icon="addIcon"
          @click="addEmployment(index)"
          v-show="index == employments.length - 1"
        />
        <font-awesome-icon
          :icon="removeIcon"
          @click="removeEmployment(index)"
          v-show="index || (!index && employments.length > 1)"
        />
      </div>
    </div>

    <span v-if="!showLanguages" @click="languageFields()"
      >Pievienot valodu</span
    >

    <div v-if="showLanguages">
      <h3>Valodas</h3>
      <div v-for="(language, index) in languages" :key="index">
        <div>
          <label>Valoda</label>
          <input type="text" v-model="language.language" />
        </div>
        <div>
          <label>Līmenis</label>
          <input type="text" v-model="language.level" />
        </div>

        <font-awesome-icon
          :icon="addIcon"
          @click="addLanguage(index)"
          v-show="index == languages.length - 1"
        />
        <font-awesome-icon
          :icon="removeIcon"
          @click="removeLanguage(index)"
          v-show="index || (!index && languages.length > 1)"
        />
      </div>
    </div>
    <span v-if="showLanguages" @click="hideLanguages()">Slēpt valodu</span>

    <button @click="addData()" type="button">Izveidot</button>
  </form>
</template>
<script>
import { FontAwesomeIcon } from "@fortawesome/vue-fontawesome";
import { faPlusSquare } from "@fortawesome/free-solid-svg-icons";
import { faTrash } from "@fortawesome/free-solid-svg-icons";

export default {
  components: {
    FontAwesomeIcon,
  },
  data() {
    return {
      basicData: {
        name: "",
        surname: "",
        phone: "",
        email: "",
      },
      address: {
        country: "",
        city: "",
        street: "",
        houseNumber: "",
        postIndex: "",
      },
      educations: [
        {
          institution: "",
          faculty: "",
          level: "",
          statuss: "",
          time: "",
        },
      ],
      employments: [
        {
          institution: "",
          position: "",
          time: "",
          description: "",
          achievements: "",
        },
      ],
      showLanguages: false,
      languages: [],
      removeIcon: faTrash,
      addIcon: faPlusSquare,
      errors: [],
    };
  },
  methods: {
    checkForm() {
      this.errors = [];

      this.validateBasicData();
      this.validateAddress();
      this.validateEducation();
      this.validateEmployment();
      this.validateLanguage();

      if (this.errors.length > 0) {
        return false;
      }
      return true;
    },
    validateBasicData() {
      if (!this.basicData.name) {
        this.errors.push("Name required.");
      }
      if (!this.basicData.surname) {
        this.errors.push("Surname required.");
      }
      if (!this.basicData.email) {
        this.errors.push("Email required.");
      }
    },
    validateAddress() {
      if (!this.address.country) {
        this.errors.push("Country required.");
      }
      if (!this.address.city) {
        this.errors.push("City required.");
      }
    },
    validateEducation() {
      const institutionError = "Institution required.";
      const statussError = "Statuss required.";
      const timeError = "Time required.";

      for (let i = 0; i < this.educations.length; i++) {
        if (
          !this.educations[i].institution &&
          !this.errors.includes(institutionError)
        ) {
          this.errors.push(institutionError);
        }
        if (
          !this.educations[i].statuss &&
          !this.errors.includes(statussError)
        ) {
          this.errors.push(statussError);
        }
        if (!this.educations[i].time && !this.errors.includes(timeError)) {
          this.errors.push(timeError);
        }
      }
    },
    validateEmployment() {
      const institutionError = "Employment institution required.";
      const positionError = " Employment position required.";
      const timeError = "Employment time required.";

      for (let i = 0; i < this.employments.length; i++) {
        if (
          !this.employments[i].institution &&
          !this.errors.includes(institutionError)
        ) {
          this.errors.push(institutionError);
        }
        if (
          !this.employments[i].position &&
          !this.errors.includes(positionError)
        ) {
          this.errors.push(positionError);
        }
        if (!this.employments[i].time && !this.errors.includes(timeError)) {
          this.errors.push(timeError);
        }
      }
    },
    validateLanguage() {
      const languageError = "Language required.";

      for (let i = 0; i < this.languages.length; i++) {
        if (
          !this.languages[i].language &&
          !this.errors.includes(languageError)
        ) {
          this.errors.push(languageError);
        }
      }
    },
    addEducation() {
      this.educations.push({
        institution: "",
        faculty: "",
        level: "",
        statuss: "",
        time: "",
      });
    },
    removeEducation(index) {
      this.educations.splice(index, 1);
    },
    addEmployment() {
      this.employments.push({
        institution: "",
        position: "",
        time: "",
        description: "",
        achievements: "",
      });
    },
    removeEmployment(index) {
      this.employments.splice(index, 1);
    },

    languageFields() {
      this.showLanguages = true;
      this.addLanguage();
    },
    hideLanguages() {
      this.showLanguages = false;
      this.languages = [];
    },
    addLanguage() {
      this.languages.push({
        language: "",
        level: "",
      });
    },
    removeLanguage(index) {
      this.languages.splice(index, 1);
    },

    addData() {
      if (this.checkForm()) {
        axios
          .post("create", {
            basicData: this.basicData,
            address: this.address,
            educations: this.educations,
            employments: this.employments,
            languages: this.languages,
          })
          .then((response) => {
            console.log("done");
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>