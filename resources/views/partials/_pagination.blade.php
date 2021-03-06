<div class="row" v-if="totalPage > 1">
	<ul class="nav nav-list">

		<li v-class="disabled: currentPage == 0 ">
			<a href="#!" v-on="click: setPage(0)">
				<i class="icon">fast_rewind</i>
			</a>
		</li>

		<li v-repeat="
				pageNumber: totalPage
				"
		    v-class="
				active: currentPage == pageNumber,
				waves-effect: currentPage ! = pageNumber,
				blue: currentPage == pageNumber"
				>
			<a href="#!"  v-on="click: setPage(pageNumber)">@{{ pageNumber + 1 }}</a>
		</li>

		<li v-class="disabled: currentPage === totalPage-1">
			<a href="#!" v-on="click: setPage(totalPage - 1)">
				<span class="icon">fast_forward</span>
			</a>
		</li>
	</ul>
</div>