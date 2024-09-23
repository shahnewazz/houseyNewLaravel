( function ( $ ) {
    'use strict';




    // enable tooltip
    const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]');
    const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl));  
    
    // enable popover
    const popoverTriggerList = document.querySelectorAll('[data-bs-toggle="popover"]')
    const popoverList = [...popoverTriggerList].map(popoverTriggerEl => new bootstrap.Popover(popoverTriggerEl))


        const getStoredTheme = () => localStorage.getItem("conca_theme");
        const setStoredTheme = (theme) => localStorage.setItem("conca_theme", theme);
      
        const getPreferredTheme = () => {
          const storedTheme = getStoredTheme();
          if (storedTheme) {
            return storedTheme;
          }
      
          return window.matchMedia("(prefers-color-scheme: dark)").matches
            ? "dark"
            : "light";
        };
      
        const setTheme = (theme) => {
          if (
            theme === "auto" &&
            window.matchMedia("(prefers-color-scheme: dark)").matches
          ) {
            document.documentElement.setAttribute("data-bs-theme", "dark");
          } else {
            document.documentElement.setAttribute("data-bs-theme", theme);
          }
        };
      
        setTheme(getPreferredTheme());
      
        const showActiveTheme = (theme, focus = false) => {
      
          const btnToActive = document.querySelector(
            `[data-bs-theme-value="${theme}"]`
          );

      
          document.querySelectorAll("[data-bs-theme-value]").forEach((element) => {
            element.classList.remove("active");
          });
      
          btnToActive.classList.add("active");
        };
      
        window
          .matchMedia("(prefers-color-scheme: dark)")
          .addEventListener("change", () => {
            const storedTheme = getStoredTheme();
            if (storedTheme !== "light" && storedTheme !== "dark") {
              setTheme(getPreferredTheme());
            }
          });
      
        window.addEventListener("DOMContentLoaded", () => {
          showActiveTheme(getPreferredTheme());
      
          document.querySelectorAll("[data-bs-theme-value]").forEach((toggle) => {
            toggle.addEventListener("click", () => {
              const theme = toggle.getAttribute("data-bs-theme-value");
              setStoredTheme(theme);
              setTheme(theme);
              showActiveTheme(theme, true);
            });
          });
        });
  $('[data-width]').each(function(){
    $(this).css('width', $(this).data('width'))
  });
  $('[data-height]').each(function(){
    $(this).css('height', $(this).data('height'))
  });
  $('[data-background]').each(function(){
    $(this).css('background', $(this).data('background'))
  });
  $('[data-color]').each(function(){
    $(this).css('color', $(this).data('color'))
  });


}(jQuery) )

