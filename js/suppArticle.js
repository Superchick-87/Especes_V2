/* Remplace une chaîne. */

function suppArticle(strr) {
  strr = strr.replace(" (Le)", "");
  strr = strr.replace(" (La)", "");
  strr = strr.replace(" (L')", "");
  return strr;
}