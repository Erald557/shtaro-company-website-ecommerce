<?php
@session_start();

if (!isset($_SESSION["customer_email"])) {
  echo "<script>window.open('../checkout.php','_self');</script>";
}
 ?>
<center><!-- center starts-->
	<h1> Paguaj Offline </h1>
	<p class="text-muted">
		Nëse keni ndonjë pyetje ,ju lutemi ndjehuni te lirë të na<a href="../contact.php"> kontaktoni </a>, qëndra jonë e shërbimit të klientit punon për ju 12/6.
	</p>
</center><!-- center ends-->

<hr>

<div class="table-responsive"><!-- table-responsive starts-->
	<table class="table table-bordered table-hover table-striped"><!-- table table-bordered table-hover table-striped starts-->
		<thead><!-- thead starts-->
			<tr>
				<th> Llogaria Bankare Detajet </th>
				<th> Paypal, Credit Card Detajet: </th>
				<th> Western Union Detajet: </th>
			</tr>

		</thead><!-- thead ends-->

		<tbody><!-- tbody starts-->
			<tr>
				<td>Emri Bankës:Fibank Nr Llogarisë:0000275486 Kodi Degës:SGAL1253 Emri Degës:Fibank Tiranë </td>
				<td> NIC#0023156 Nr Telefoni:0689635621, Emri:Filan Fisteku </td>
				<td>Emri i Plotë:Filan Fisteku, Nr Telefoni:068534433, Emri:Filan Fisteku </td>
			</tr>

		</tbody><!-- tbody ends-->
	</table><!-- table table-bordered table-hover table-striped ends-->

</div><!-- table-responsive ends-->
