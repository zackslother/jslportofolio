module.exports = {
  content: ["./src/**/*.{html,js,jsx,ts,tsx}"],
  theme: {
    extend: {
      colors: {
        "my-custom-blue": "#1a2b3c",
        "brand-primary": {
          DEFAULT: "#ff5733",
          light: "#ff8c66",
          dark: "#cc452b",
        },
      },
    },
  },
  plugins: [],
};
