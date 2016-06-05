<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><div class="page-content">
		<div class="isi-status" id="">
			<div class="content-inti" id="reload">
				<div class="well">
					<div class="row">
						<div class="col-sm-6 col-sm-offset-3">
							<?php echo form_open('administrator/status', array('method' => 'get')) ?>
							<div class="row">
									<div class="col-sm-5">
										<div class="input-group">
											<span class="input-group-addon">Tanggal Mulai</span>
											<?php echo form_input(array('name' => 'tanggal_mulai', 'value' => $tanggal_mulai ,'class' => 'bg-white form-control form-bulan', 'id' => 'datetimepicker9', 'data-date-format' => 'YYYY-MM-DD', 'autocomplete' => 'off', 'readonly' => ''))?>
										</div>
									</div>
									<div class="col-sm-5">
										<div class="input-group">
											<span class="input-group-addon">Tanggal Akhir</span>
											<?php echo form_input(array('name' => 'tanggal_akhir', 'value' => $tanggal_akhir ,'class' => 'bg-white form-control form-bulan', 'id' => 'datetimepicker10', 'data-date-format' => 'YYYY-MM-DD', 'autocomplete' => 'off', 'readonly' => ''))?>
										</div>
									</div>
									<div class="col-sm-2">
										<?php echo form_button(array('content' => '<i class="glyphicon glyphicon-search"></i>', 'class' => 'btn btn-block btn-default', 'type' => 'submit')) ?>
									</div>
								</div>
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- status jumlah pesanan -->
					<div class="col-sm-3">
						<div class="panel panel-success">
							<div class="panel-heading">Berdasarkan <strong>Jumlah Pesanan</strong> (pcs).</div>
							<div class="panel-bodsy">
								<div class="table-responsive">
									<table class="table table-hover">
										<thead>
											<tr>
												<th>#</th>
												<th>Juragan</th>
												<th class="text-center">Jumlah</th>
											</tr>
										</thead>
										<tbody>
											<?php $query = $total_pesanan; 
											$i=1;
											if ($query->num_rows() > 0)
											{
												foreach ($query->result() as $row)
												{
													?>
													<tr <?php if($row->user_id === data_session('id')) { echo 'class="success text-bold"';} ?>>
														<td><?php echo $i++; ?></td>
														<td><?php echo $row->juragan; ?></td>
														<td class="text-center"><?php echo $row->total; ?></td>
													</tr>
													<?php }
												} ?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>

						<!-- status jumlah transfer -->
						<div class="col-sm-3">
							<div class="panel panel-info">
								<div class="panel-heading">Berdasarkan <strong>Jumlah Transfer</strong>.</div>
								<div class="panel-bodsy">
									<div class="table-responsive">
										<table class="table table-hover">
											<thead>
												<tr>
													<th>#</th>
													<th>Juragan</th>
													<th class="text-center">Jumlah</th>
												</tr>
											</thead>
											<tbody>
												<?php $query = $total_transfer; 
												$i=1;
												if ($query->num_rows() > 0)
												{
													foreach ($query->result() as $row)
													{
														?>
														<tr <?php if($row->user_id === data_session('id')) { echo 'class="info text-bold"';} ?>>
															<td><?php echo $i++; ?></td>
															<td><?php echo $row->juragan; ?></td>
															<td class="text-center"><?php echo $row->total; ?></td>
														</tr>
														<?php }
													} ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<!-- status pesanan terkirim -->
							<div class="col-sm-3">
								<div class="panel panel-warning">
									<div class="panel-heading">Berdasarkan <strong>Jumlah Terkirim</strong> (pcs).</div>
									<div class="panel-bodsy">
										<div class="table-responsive">
											<table class="table table-hover">
												<thead>
													<tr>
														<th>#</th>
														<th>Juragan</th>
														<th class="text-center">Jumlah</th>
													</tr>
												</thead>
												<tbody>
													<?php $query = $total_terkirim; 
													$i=1;
													if ($query->num_rows() > 0)
													{
														foreach ($query->result() as $row)
														{
															?>
															<tr <?php if($row->user_id === data_session('id')) { echo 'class="warning text-bold"';} ?>>
																<td><?php echo $i++; ?></td>
																<td><?php echo $row->juragan; ?></td>
																<td class="text-center"><?php echo $row->total; ?></td>
															</tr>
															<?php }
														} ?>
													</tbody>
												</table>
											</div>
										</div>
									</div>
								</div>

								<!-- status pesanan pending -->
								<div class="col-sm-3">
									<div class="panel panel-danger">
										<div class="panel-heading">Berdasarkan <strong>Pesanan Pending</strong> (pcs).</div>
										<div class="panel-bodsy">
											<div class="table-responsive">
												<table class="table table-hover">
													<thead>
														<tr>
															<th>#</th>
															<th>Juragan</th>
															<th class="text-center">Jumlah</th>
														</tr>
													</thead>
													<tbody>
														<?php $query = $total_pending; 
														$i=1;
														if ($query->num_rows() > 0)
														{
															foreach ($query->result() as $row)
															{
																?>
																<tr <?php if($row->user_id === data_session('id')) { echo 'class="danger text-bold"';} ?>>
																	<td><?php echo $i++; ?></td>
																	<td><?php echo $row->juragan; ?></td>
																	<td class="text-center"><?php echo $row->total; ?></td>
																</tr>
																<?php }
															} ?>
														</tbody>
													</table>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>